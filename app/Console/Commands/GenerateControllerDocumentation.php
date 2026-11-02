<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ReflectionClass;
use ReflectionMethod;

class GenerateControllerDocumentation extends Command
{
    protected $signature = 'docs:controllers';
    protected $description = 'Generate controller docs';

    public function handle()
    {
        $doc = "# Controllers\n\n";

        foreach (File::allFiles(app_path('Http/Controllers')) as $file) {
            $className = 'App\\Http\\Controllers\\' . str_replace(['/', '\\', '.php'], ['\\', '\\', ''], $file->getRelativePathname());
            if (!class_exists($className) || $file->getFilename() === 'Controller.php') {
                continue;
            }

            $doc .= "## {$className}\n";
            $doc .= "**Location:** app/Http/Controllers/{$file->getRelativePathname()}\n\n";
            $doc .= "| Method |\n|--------|\n";

            $reflection = new ReflectionClass($className);
            foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                if ($method->class === $className && !$method->isConstructor()) {
                    $doc .= "| {$method->getName()}() |\n";
                }
            }
            $doc .= "\n";
        }

        File::ensureDirectoryExists(base_path('docs'));
        File::put(base_path('docs/controllers.md'), $doc);
        $this->info('Controllers docs generated at docs/controllers.md');
    }
}
