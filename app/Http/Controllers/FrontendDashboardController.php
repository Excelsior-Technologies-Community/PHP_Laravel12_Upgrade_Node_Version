<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class FrontendDashboardController extends Controller
{
    /**
     * Display the frontend environment dashboard.
     */
    public function index()
    {
        $packagePath = base_path('package.json');

        $package = [];

        if (File::exists($packagePath)) {
            $package = json_decode(
                File::get($packagePath),
                true
            ) ?? [];
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

        $viteVersion = $this->getPackageVersion(
            $dependencies,
            'vite'
        );

        $tailwindVersion = $this->getPackageVersion(
            $dependencies,
            'tailwindcss'
        );

        $postcssVersion = $this->getPackageVersion(
            $dependencies,
            'postcss'
        );

        $autoprefixerVersion = $this->getPackageVersion(
            $dependencies,
            'autoprefixer'
        );

        $laravelViteVersion = $this->getPackageVersion(
            $dependencies,
            'laravel-vite-plugin'
        );

        /*
        |--------------------------------------------------------------------------
        | Build Status
        |--------------------------------------------------------------------------
        */

        $buildManifestPath = public_path(
            'build/manifest.json'
        );

        $buildStatus = File::exists(
            $buildManifestPath
        );

        /*
        |--------------------------------------------------------------------------
        | Dependency Status
        |--------------------------------------------------------------------------
        */

        $dependencyStatus = [
            'vite' => $viteVersion !== 'Not configured',
            'tailwindcss' => $tailwindVersion !== 'Not configured',
            'postcss' => $postcssVersion !== 'Not configured',
            'autoprefixer' => $autoprefixerVersion !== 'Not configured',
            'laravel-vite-plugin' => $laravelViteVersion !== 'Not configured',
        ];

        /*
        |--------------------------------------------------------------------------
        | Environment Checks
        |--------------------------------------------------------------------------
        */

        $nodeVersion = $this->getNodeVersion();
        $npmVersion = $this->getNpmVersion();

        $environmentChecks = [
            'Laravel' => app()->version() !== '',
            'PHP' => PHP_VERSION !== '',
            'Node.js' => $nodeVersion !== 'Not detected',
            'npm' => $npmVersion !== 'Not detected',
            'Vite' => $dependencyStatus['vite'],
            'Tailwind CSS' => $dependencyStatus['tailwindcss'],
            'PostCSS' => $dependencyStatus['postcss'],
            'Autoprefixer' => $dependencyStatus['autoprefixer'],
            'Laravel Vite Plugin' => $dependencyStatus['laravel-vite-plugin'],
        ];

        $healthyCount = count(
            array_filter($environmentChecks)
        );

        $totalChecks = count($environmentChecks);

        $healthPercentage = $totalChecks > 0
            ? round(($healthyCount / $totalChecks) * 100)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Project Statistics
        |--------------------------------------------------------------------------
        */

        $projectStatistics = [
            'controllers' => $this->countFiles(
                app_path('Http/Controllers'),
                'php'
            ),

            'blade' => $this->countFiles(
                resource_path('views'),
                'blade.php'
            ),

            'javascript' => $this->countFiles(
                resource_path('js'),
                'js'
            ),

            'css' => $this->countFiles(
                resource_path('css'),
                'css'
            ),

            'migrations' => $this->countFiles(
                database_path('migrations'),
                'php'
            ),

            'routes' => $this->countFiles(
                base_path('routes'),
                'php'
            ),
        ];

        /*
        |--------------------------------------------------------------------------
        | Package Information
        |--------------------------------------------------------------------------
        */

        $allDependencies = [];

        foreach ($package['dependencies'] ?? [] as $name => $version) {
            $allDependencies[] = [
                'name' => $name,
                'version' => $version,
                'type' => 'dependency',
            ];
        }

        foreach ($package['devDependencies'] ?? [] as $name => $version) {
            $allDependencies[] = [
                'name' => $name,
                'version' => $version,
                'type' => 'devDependency',
            ];
        }

        usort(
            $allDependencies,
            fn ($a, $b) => strcmp(
                $a['name'],
                $b['name']
            )
        );

        /*
        |--------------------------------------------------------------------------
        | NPM Scripts
        |--------------------------------------------------------------------------
        */

        $scripts = $package['scripts'] ?? [];

        /*
        |--------------------------------------------------------------------------
        | Environment Information
        |--------------------------------------------------------------------------
        */

        $environment = [
            'APP_ENV' => env('APP_ENV', 'Not configured'),
            'APP_DEBUG' => env('APP_DEBUG', 'Not configured'),
            'APP_URL' => env('APP_URL', 'Not configured'),
            'PHP_OS' => PHP_OS,
            'Server' => $_SERVER['SERVER_SOFTWARE'] ?? 'PHP Built-in Server',
        ];

        /*
        |--------------------------------------------------------------------------
        | Return Dashboard
        |--------------------------------------------------------------------------
        */

        return view('frontend-dashboard', [

            'laravelVersion' => app()->version(),

            'phpVersion' => PHP_VERSION,

            'nodeVersion' => $nodeVersion,

            'npmVersion' => $npmVersion,

            'viteVersion' => $viteVersion,

            'tailwindVersion' => $tailwindVersion,

            'postcssVersion' => $postcssVersion,

            'autoprefixerVersion' => $autoprefixerVersion,

            'laravelViteVersion' => $laravelViteVersion,

            'packageName' => $package['name']
                ?? 'Laravel Application',

            'scripts' => $scripts,

            'buildStatus' => $buildStatus,

            'dependencyStatus' => $dependencyStatus,

            'environmentChecks' => $environmentChecks,

            'healthyCount' => $healthyCount,

            'totalChecks' => $totalChecks,

            'healthPercentage' => $healthPercentage,

            'projectStatistics' => $projectStatistics,

            'allDependencies' => $allDependencies,

            'environment' => $environment,

            'lastChecked' => now()->format(
                'd M Y, h:i:s A'
            ),
        ]);
    }

    /**
     * Export dashboard information as JSON.
     */
    public function export()
    {
        $packagePath = base_path('package.json');

        $package = [];

        if (File::exists($packagePath)) {
            $package = json_decode(
                File::get($packagePath),
                true
            ) ?? [];
        }

        $report = [
            'generated_at' => now()->toDateTimeString(),

            'project' => [
                'name' => $package['name']
                    ?? 'Laravel Application',
            ],

            'laravel' => app()->version(),

            'php' => PHP_VERSION,

            'node' => $this->getNodeVersion(),

            'npm' => $this->getNpmVersion(),

            'dependencies' => [
                'dependencies' =>
                    $package['dependencies'] ?? [],

                'devDependencies' =>
                    $package['devDependencies'] ?? [],
            ],

            'build' => [
                'manifest_exists' => File::exists(
                    public_path(
                        'build/manifest.json'
                    )
                ),
            ],

            'environment' => [
                'APP_ENV' => env(
                    'APP_ENV',
                    'Not configured'
                ),

                'APP_DEBUG' => env(
                    'APP_DEBUG',
                    'Not configured'
                ),

                'APP_URL' => env(
                    'APP_URL',
                    'Not configured'
                ),
            ],
        ];

        return response()->json(
            $report,
            200,
            [
                'Content-Disposition' =>
                    'attachment; filename="frontend-dashboard-report.json"',
            ]
        );
    }

    /**
     * Count files recursively.
     */
    private function countFiles(
        string $directory,
        string $extension
    ): int {
        if (!File::isDirectory($directory)) {
            return 0;
        }

        return count(
            File::allFiles($directory)
        );
    }

    /**
     * Get Node.js version.
     */
    private function getNodeVersion(): string
    {
        $version = @shell_exec('node -v');

        return $this->cleanCommandOutput(
            $version,
            'Not detected'
        );
    }

    /**
     * Get npm version.
     */
    private function getNpmVersion(): string
    {
        $version = @shell_exec('npm -v');

        return $this->cleanCommandOutput(
            $version,
            'Not detected'
        );
    }

    /**
     * Get package version.
     */
    private function getPackageVersion(
        array $dependencies,
        string $packageName
    ): string {
        return $dependencies[$packageName]
            ?? 'Not configured';
    }

    /**
     * Clean shell command output.
     */
    private function cleanCommandOutput(
        ?string $output,
        string $fallback
    ): string {
        if (!$output) {
            return $fallback;
        }

        $output = trim($output);

        return $output !== ''
            ? $output
            : $fallback;
    }
}