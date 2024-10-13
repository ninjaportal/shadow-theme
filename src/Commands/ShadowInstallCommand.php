<?php

namespace NinjaPortal\Shadow\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class ShadowInstallCommand extends Command
{
    protected $signature = 'ninja-shadow:install';

    protected $description = 'Install the Ninja Shadow package';

    public function handle(): void
    {
        $this->info('Checking and removing the default route from web.php...');
        $this->removeDefaultRoute();

        // copying assets and views
        $this->info('Publishing assets ...');
        $this->call('vendor:publish', ['--tag' => 'shadow-assets', '--force' => true]);
        $this->info('Publishing views ...');
        $this->call('vendor:publish', ['--tag' => 'shadow-theme-views', '--force' => true]);
        $this->info('Publishing js ...');
    }

    /**
     * Remove the default Laravel welcome route from web.php.
     */
    protected function removeDefaultRoute(): void
    {
        $webRoutePath = base_path('routes/web.php');

        if (File::exists($webRoutePath)) {
            // Load the contents of web.php
            $content = File::get($webRoutePath);

            // Define the default route content to search and remove
            $defaultRoute = "Route::get('/', function () {\n    return view('welcome');\n});\n";

            // Check if the default route exists in the file
            if (str_contains($content, $defaultRoute)) {
                // Remove the default route from the file content
                $newContent = str_replace($defaultRoute, '', $content);

                // Save the modified content back to web.php
                File::put($webRoutePath, $newContent);

                $this->info('Default route removed successfully.');
            } else {
                $this->info('No default route found.');
            }
        } else {
            $this->error('routes/web.php not found.');
        }
    }


    public function npmInstall(string $package): void
    {
        Process::run("npm install $package", function ($type, $buffer) {
            if ($type === "err")
                $this->error($buffer);
            else
                $this->info($buffer);
        });
    }
}
