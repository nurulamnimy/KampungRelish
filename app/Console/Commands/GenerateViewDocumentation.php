<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateViewDocumentation extends Command
{
    protected $signature = 'docs:views';
    protected $description = 'Generate Blade template docs';

    public function handle()
    {
        $views = collect(File::allFiles(resource_path('views')))
            ->filter(fn($file) => str_ends_with($file->getFilename(), '.blade.php'));

        $doc = "# Blade Views\n\n| View | Location |\n|------|----------|\n";

        foreach ($views as $view) {
            $path = str_replace('\\', '/', $view->getRelativePathname());
            $name = str_replace('.blade.php', '', $path);
            $doc .= "| {$name} | resources/views/{$path} |\n";
        }

        File::ensureDirectoryExists(base_path('docs'));
        File::put(base_path('docs/views.md'), $doc);
        $this->info('Views docs generated at docs/views.md');
    }
}
