<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateRouteDocumentation extends Command
{
    protected $signature = 'docs:routes';
    protected $description = 'Generate route docs';

    public function handle()
    {
        $doc = "# Routes\n\n| Method | URI | Name | Action | Middleware |\n|--------|-----|------|--------|------------|\n";

        foreach (app('router')->getRoutes() as $route) {
            // skip the framework / debug routes
            if (str_starts_with($route->uri(), '_') || str_starts_with($route->uri(), 'sanctum') || str_starts_with($route->uri(), 'api')) {
                continue;
            }
            $doc .= sprintf(
                "| %s | /%s | %s | %s | %s |\n",
                implode(',', $route->methods()),
                $route->uri(),
                $route->getName() ?? '-',
                $route->getActionName(),
                implode(', ', array_filter($route->gatherMiddleware(), 'is_string'))
            );
        }

        File::ensureDirectoryExists(base_path('docs'));
        File::put(base_path('docs/routes.md'), $doc);
        $this->info('Routes docs generated at docs/routes.md');
    }
}
