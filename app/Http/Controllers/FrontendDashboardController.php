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

        return view('frontend-dashboard', [
            'laravelVersion' => app()->version(),
            'phpVersion' => PHP_VERSION,
            'nodeVersion' => $this->getNodeVersion(),
            'npmVersion' => $this->getNpmVersion(),

            'viteVersion' => $this->getPackageVersion(
                $dependencies,
                'vite'
            ),

            'tailwindVersion' => $this->getPackageVersion(
                $dependencies,
                'tailwindcss'
            ),

            'postcssVersion' => $this->getPackageVersion(
                $dependencies,
                'postcss'
            ),

            'autoprefixerVersion' => $this->getPackageVersion(
                $dependencies,
                'autoprefixer'
            ),

            'laravelViteVersion' => $this->getPackageVersion(
                $dependencies,
                'laravel-vite-plugin'
            ),

            'packageName' => $package['name'] ?? 'Laravel Application',

            'scripts' => $package['scripts'] ?? [],

            'buildStatus' => File::exists(
                public_path('build/manifest.json')
            ),
        ]);
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
        return $dependencies[$packageName] ?? 'Not configured';
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