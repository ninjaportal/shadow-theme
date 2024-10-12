<?php

namespace NinjaPortal\Shadow\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class ShadowInstallCommand extends Command
{
    protected $signature = 'ninja-shadow:install';

    protected $description = 'Install the Ninja Shadow package';

    public function handle(): void
    {

        // copying assets and views
        $this->info('Publishing assets ...');
        $this->call('vendor:publish', ['--tag' => 'shadow-assets', '--force' => true]);
        $this->info('Publishing views ...');
        $this->call('vendor:publish', ['--tag' => 'shadow-theme-views', '--force' => true]);
        $this->info('Publishing js ...');
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
