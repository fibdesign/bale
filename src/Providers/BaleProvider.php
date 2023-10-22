<?php

namespace Fibdesign\Bale\Providers;
use Illuminate\Support\ServiceProvider;

class BaleProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfig();
    }

    public function boot()
    {
        $this->publishConfig();
    }

    private function mergeConfig()
    {
        $path = $this->getConfigPath();
        $this->mergeConfigFrom($path, 'bale');
    }

    private function publishConfig()
    {
        $path = $this->getConfigPath();
        $this->publishes([$path => config_path('bale.php')], 'config');
    }

    private function getConfigPath(): string
    {
        return __DIR__ . '/../config/bale.php';
    }
}
