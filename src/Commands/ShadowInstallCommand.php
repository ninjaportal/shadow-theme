<?php

namespace NinjaPortal\Shadow\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ShadowInstallCommand extends Command
{
    protected $signature = 'shadow:install 
                            {--views : Publish views for customization}
                            {--config : Publish configuration file}
                            {--frontend : Publish frontend resources (JS/CSS)}
                            {--lang : Publish language files}
                            {--tailwind : Publish Tailwind configuration}
                            {--all : Publish all resources}
                            {--force : Overwrite existing files}';

    protected $aliases = ['ninja-shadow:install'];

    protected $description = 'Install the Shadow theme package';

    public function handle(): void
    {
        $this->info('🎨 Installing Shadow Theme...');
        $this->newLine();

        $options = $this->option('force') ? ['--force' => true] : [];

        if ($this->option('all')) {
            $this->publishEverything($options);
            $this->completeInstallation();
            return;
        }

        // Always publish required assets
        $this->info('📦 Publishing required assets...');
        $this->call('vendor:publish', array_merge(
            ['--tag' => 'shadow-assets'],
            $options
        ));

        // Optional publishes based on flags
        if ($this->option('views')) {
            $this->info('👁️  Publishing views...');
            $this->call('vendor:publish', array_merge(
                ['--tag' => 'shadow-views'],
                $options
            ));
        }

        if ($this->option('config')) {
            $this->info('⚙️  Publishing configuration...');
            $this->call('vendor:publish', array_merge(
                ['--tag' => 'shadow-config'],
                $options
            ));
        }

        if ($this->option('frontend')) {
            $this->info('🎨 Publishing frontend resources...');
            $this->call('vendor:publish', array_merge(
                ['--tag' => 'shadow-frontend'],
                $options
            ));
        }

        if ($this->option('lang')) {
            $this->info('🌍 Publishing language files...');
            $this->call('vendor:publish', array_merge(
                ['--tag' => 'shadow-lang'],
                $options
            ));
        }

        if ($this->option('tailwind')) {
            $this->info('🎨 Publishing Tailwind configuration...');
            $this->call('vendor:publish', array_merge(
                ['--tag' => 'shadow-tailwind'],
                $options
            ));
        }

        $this->completeInstallation();
    }

    /**
     * Publish all resources
     */
    protected function publishEverything(array $options): void
    {
        $tags = [
            'shadow-assets' => '📦 Publishing assets...',
            'shadow-views' => '👁️  Publishing views...',
            'shadow-config' => '⚙️  Publishing configuration...',
            'shadow-frontend' => '🎨 Publishing frontend resources...',
            'shadow-lang' => '🌍 Publishing language files...',
            'shadow-tailwind' => '🎨 Publishing Tailwind configuration...',
        ];

        foreach ($tags as $tag => $message) {
            $this->info($message);
            $this->call('vendor:publish', array_merge(['--tag' => $tag], $options));
        }
    }

    /**
     * Complete installation tasks
     */
    protected function completeInstallation(): void
    {
        $this->newLine();
        $this->removeDefaultRoute();
        
        $this->newLine();
        $this->info('✅ Shadow theme installed successfully!');
        $this->newLine();
        
        $this->comment('📚 Next steps:');
        $this->line('  1. Run: npm install && npm run build');
        $this->line('  2. Configure your .env file with Shadow settings');
        $this->line('  3. Visit your application to see the theme in action');
        $this->newLine();
        
        $this->comment('💡 Tip: Use --help to see all available options');
    }

    /**
     * Remove the default Laravel welcome route from web.php
     */
    protected function removeDefaultRoute(): void
    {
        $webRoutePath = base_path('routes/web.php');

        if (!File::exists($webRoutePath)) {
            $this->warn('⚠️  routes/web.php not found.');
            return;
        }

        $content = File::get($webRoutePath);

        // Define the default route patterns to search and remove
        $patterns = [
            "Route::get('/', function () {\n    return view('welcome');\n});\n",
            "Route::get('/', function () {\n    return view('welcome');\n});",
        ];

        $found = false;
        foreach ($patterns as $pattern) {
            if (str_contains($content, $pattern)) {
                $content = str_replace($pattern, '', $content);
                $found = true;
                break;
            }
        }

        if ($found) {
            File::put($webRoutePath, $content);
            $this->info('🗑️  Default route removed from web.php');
        } else {
            $this->info('ℹ️  No default route found in web.php');
        }
    }
}
