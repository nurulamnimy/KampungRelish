<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GenerateModelDocumentation extends Command
{
    protected $signature = 'docs:models';
    protected $description = 'Generate model documentation (tables, columns, keys)';

    public function handle()
    {
        $doc = "# Models Documentation\n\nGenerated on: " . now()->toDateTimeString() . "\n\n";

        foreach (File::allFiles(app_path('Models')) as $file) {
            $className = 'App\\Models\\' . str_replace(['/', '.php'], ['\\', ''], $file->getRelativePathname());
            if (!class_exists($className) || !is_subclass_of($className, Model::class)) {
                continue;
            }

            $model = new $className;
            $table = $model->getTable();
            $doc .= "## " . class_basename($className) . "\n\n";
            $doc .= "**Table:** `{$table}`\n\n**Primary Key:** `{$model->getKeyName()}`\n\n";

            try {
                $columns = DB::select("SHOW COLUMNS FROM {$table}");
            } catch (\Exception $e) {
                $doc .= "_Table not found. Run php artisan migrate first._\n\n";
                continue;
            }

            $doc .= "| Field | Type | Null | Key | Default |\n|-------|------|------|-----|---------|\n";
            foreach ($columns as $col) {
                $doc .= "| `{$col->Field}` | {$col->Type} | {$col->Null} | {$col->Key} | " . ($col->Default ?? 'NULL') . " |\n";
            }

            $doc .= "\n**Fillable:** " . implode(', ', $model->getFillable()) . "\n\n---\n\n";
        }

        File::ensureDirectoryExists(base_path('docs'));
        File::put(base_path('docs/models.md'), $doc);
        $this->info('Models docs generated at docs/models.md');
    }
}
