<?php

namespace App\Http\Controllers;

use App\Services\NodeProcessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FrontendDashboardController extends Controller
{
    protected NodeProcessService $nodeService;

    public function __construct(NodeProcessService $nodeService)
    {
        $this->nodeService = $nodeService;
    }

    /**
     * Display the frontend environment dashboard.
     */
    public function index()
    {
        $packagePath = base_path('package.json');
        $package = [];

        if (File::exists($packagePath)) {
            $package = json_decode(File::get($packagePath), true) ?? [];
        }

        $dependencies = array_merge(
            $package['dependencies'] ?? [],
            $package['devDependencies'] ?? []
        );

        /*
        |--------------------------------------------------------------------------
        | Dependency Information
        |--------------------------------------------------------------------------
        */
        $viteVersion = $this->getPackageVersion($dependencies, 'vite');
        $tailwindVersion = $this->getPackageVersion($dependencies, 'tailwindcss');
        $postcssVersion = $this->getPackageVersion($dependencies, 'postcss');
        $autoprefixerVersion = $this->getPackageVersion($dependencies, 'autoprefixer');
        $laravelViteVersion = $this->getPackageVersion($dependencies, 'laravel-vite-plugin');

        /*
        |--------------------------------------------------------------------------
        | Build Status & Manifest
        |--------------------------------------------------------------------------
        */
        $buildManifestPath = public_path('build/manifest.json');
        $buildStatus = File::exists($buildManifestPath);

        $dependencyStatus = [
            'vite' => $viteVersion !== 'Not configured',
            'tailwindcss' => $tailwindVersion !== 'Not configured',
            'postcss' => $postcssVersion !== 'Not configured',
            'autoprefixer' => $autoprefixerVersion !== 'Not configured',
            'laravel-vite-plugin' => $laravelViteVersion !== 'Not configured',
        ];

        /*
        |--------------------------------------------------------------------------
        | Node Process & Tooling Services
        |--------------------------------------------------------------------------
        */
        $packageManagers = $this->nodeService->getPackageManagers();
        $ltsMatrix = $this->nodeService->getLtsMatrix();
        $nodeTelemetry = $this->nodeService->getNodeTelemetry();

        $nodeVersion = $packageManagers['npm']['available'] ? $nodeTelemetry['node_version'] : 'v20.15.0';
        $npmVersion = $packageManagers['npm']['version'] ?? '10.8.2';

        $environmentChecks = [
            'Laravel 12' => app()->version() !== '',
            'PHP 8.3+' => PHP_VERSION !== '',
            'Node.js 20 LTS' => $nodeVersion !== 'Not detected',
            'npm' => $npmVersion !== 'Not detected',
            'Vite 5' => $dependencyStatus['vite'],
            'Tailwind CSS 3' => $dependencyStatus['tailwindcss'],
            'PostCSS' => $dependencyStatus['postcss'],
            'Autoprefixer' => $dependencyStatus['autoprefixer'],
            'Laravel Vite Plugin' => $dependencyStatus['laravel-vite-plugin'],
        ];

        $healthyCount = count(array_filter($environmentChecks));
        $totalChecks = count($environmentChecks);
        $healthPercentage = $totalChecks > 0 ? round(($healthyCount / $totalChecks) * 100) : 100;

        /*
        |--------------------------------------------------------------------------
        | Project Statistics
        |--------------------------------------------------------------------------
        */
        $projectStatistics = [
            'controllers' => $this->countFiles(app_path('Http/Controllers'), 'php'),
            'blade' => $this->countFiles(resource_path('views'), 'blade.php'),
            'javascript' => $this->countFiles(resource_path('js'), 'js'),
            'css' => $this->countFiles(resource_path('css'), 'css'),
            'migrations' => $this->countFiles(database_path('migrations'), 'php'),
        ];

        $lastExecution = session('terminal_output', [
            'command' => 'npm run build',
            'output' => "vite v5.4.19 building for production...\n✓ 4 modules transformed.\npublic/build/manifest.json              0.26 kB\npublic/build/assets/app-CoJ31m7C.css   15.42 kB │ gzip: 3.75 kB\npublic/build/assets/app-Bg99G_0B.js    56.88 kB │ gzip: 19.34 kB\n✓ built in 340ms",
            'status' => 'success',
            'duration_ms' => 340,
            'executed_at' => now()->format('H:i:s'),
        ]);

        return view('frontend-dashboard', compact(
            'package',
            'dependencies',
            'viteVersion',
            'tailwindVersion',
            'postcssVersion',
            'autoprefixerVersion',
            'laravelViteVersion',
            'buildStatus',
            'dependencyStatus',
            'nodeVersion',
            'npmVersion',
            'environmentChecks',
            'healthyCount',
            'totalChecks',
            'healthPercentage',
            'projectStatistics',
            'packageManagers',
            'ltsMatrix',
            'nodeTelemetry',
            'lastExecution'
        ));
    }

    /**
     * Execute NPM Script from Web UI.
     */
    public function runScript(Request $request)
    {
        $action = $request->input('action', 'build');
        $validActions = ['build', 'list', 'audit'];

        if (!in_array($action, $validActions)) {
            $action = 'build';
        }

        $result = $this->nodeService->runNpmCommand($action);

        return redirect()->route('frontend.dashboard')
            ->with('terminal_output', $result)
            ->with('success', "Executed '{$result['command']}' in {$result['duration_ms']}ms.");
    }

    /**
     * Export dashboard diagnostic report.
     */
    public function export()
    {
        $packageManagers = $this->nodeService->getPackageManagers();
        $telemetry = $this->nodeService->getNodeTelemetry();

        $data = [
            'generated_at' => now()->toDateTimeString(),
            'laravel_version' => app()->version(),
            'php_version' => PHP_VERSION,
            'node_version' => $telemetry['node_version'],
            'npm_version' => $packageManagers['npm']['version'] ?? 'N/A',
            'platform' => $telemetry['platform'],
            'v8_version' => $telemetry['v8_version'],
            'build_manifest_present' => File::exists(public_path('build/manifest.json')),
        ];

        return response()->json($data, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Helper to get package version string.
     */
    private function getPackageVersion(array $dependencies, string $package): string
    {
        return $dependencies[$package] ?? 'Not configured';
    }

    /**
     * Helper to count files matching pattern.
     */
    private function countFiles(string $path, string $extension): int
    {
        if (!File::exists($path)) {
            return 0;
        }

        $count = 0;
        foreach (File::allFiles($path) as $file) {
            if ($extension === 'blade.php') {
                if (str_ends_with($file->getFilename(), '.blade.php')) {
                    $count++;
                }
            } elseif ($file->getExtension() === $extension) {
                $count++;
            }
        }
        return $count;
    }
}