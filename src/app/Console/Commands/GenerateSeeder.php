<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateSeeder extends Command
{
    protected $signature = 'seed:generate {table}';
    protected $description = 'Generate a seeder from an existing table';

    public function handle(): void
    {
        $table = $this->argument('table');
        $rows  = DB::table($table)->get()->map(fn($r) => (array) $r)->toArray();

        $rowsExport = implode(",\n            ", array_map(function ($row) {
            $pairs = array_map(function ($key, $val) {
                if (is_null($val)) {
                    $formatted = 'null';
                } else {
                    // Use json_encode for safe escaping, then wrap in single quotes
                    // json_encode gives us a double-quoted string, so we strip those
                    // and re-wrap in single quotes, escaping only single quotes inside
                    $formatted = "'" . str_replace("'", "\\'", $val) . "'";
                }
                return "'$key' => $formatted";
            }, array_keys($row), array_values($row));
            return "[\n                " . implode(",\n                ", $pairs) . "\n            ]";
        }, $rows));

        $className = ucfirst($table) . 'Seeder';
        $stub = <<<PHP
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class {$className} extends Seeder
{
    public function run(): void
    {
        DB::table('{$table}')->insert([
            {$rowsExport}
        ]);
    }
}
PHP;

        file_put_contents(database_path("seeders/{$className}.php"), $stub);
        $this->info("Seeder generated: database/seeders/{$className}.php");
    }
}
