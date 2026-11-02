<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateFullDocumentation extends Command
{
    protected $signature = 'docs:generate';
    protected $description = 'Generate all documentation and combine into docs/generate.md';

    public function handle()
    {
        $this->call('docs:views');
        $this->call('docs:controllers');
        $this->call('docs:models');
        $this->call('docs:routes');

        $all = "# KampungRelish Project Documentation\n\n";
        foreach (['views', 'controllers', 'models', 'routes'] as $part) {
            $all .= File::get(base_path("docs/{$part}.md")) . "\n\n";
        }
        File::put(base_path('docs/generate.md'), $all);

        $this->info('All documentation generated in docs/ folder (docs/generate.md)');
    }
}
