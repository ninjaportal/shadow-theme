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
        $this->mergeAndPublishTranslations();
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


    public function mergeAndPublishTranslations()
    {
        $ar_json_path = resource_path('lang/ar.json');
        $en_json_path = resource_path('lang/en.json');

        if (!File::exists($ar_json_path)) $ar_json = []; else $ar_json = json_decode(file_get_contents($ar_json_path), true);
        if (!File::exists($en_json_path)) $en_json = []; else $en_json = json_decode(file_get_contents($en_json_path), true);

        $ar_shadow_translations = require __DIR__ . "/../../resources/lang/ar.json";
        $en_shadow_translations = require __DIR__ . "/../../resources/lang/en.json";

        $ar_translations = array_merge($ar_json, $ar_shadow_translations);
        $en_translations = array_merge($en_json, $en_shadow_translations);

        file_put_contents($ar_json_path, json_encode($ar_translations, JSON_PRETTY_PRINT));
        file_put_contents($en_json_path, json_encode($en_translations, JSON_PRETTY_PRINT));

        $this->info('Translations merged and published successfully.');
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
