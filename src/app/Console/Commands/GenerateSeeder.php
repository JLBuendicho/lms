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
        $rows  = DB::table($table)->get()->map(fn ($r) => (array) $r)->toArray();

        $rowsExport = implode(",\n            ", array_map(function ($row) {
            $pairs = array_map(function ($key, $val) {
                return "'$key' => " . $this->formatValue($val);
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

    /**
     * Format a single column value as PHP source.
     */
    private function formatValue($val): string
    {
        if (is_null($val)) {
            return 'null';
        }

        if (is_string($val) && $this->looksLikeJson($val)) {
            $decoded = json_decode($val, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return 'json_encode(' . $this->phpArrayLiteral($decoded) . ')';
            }
        }

        return $this->phpScalarLiteral($val);
    }

    /**
     * Cheap pre-check before we bother calling json_decode().
     */
    private function looksLikeJson(string $val): bool
    {
        $trimmed = trim($val);

        return $trimmed !== '' && (str_starts_with($trimmed, '[') || str_starts_with($trimmed, '{'));
    }

    /**
     * Recursively render a decoded JSON value as PHP short-array syntax.
     */
    private function phpArrayLiteral($data, int $indent = 1): string
    {
        if (is_array($data)) {
            if ($data === []) {
                return '[]';
            }

            $pad      = str_repeat('    ', $indent);
            $closePad = str_repeat('    ', $indent - 1);
            $isList   = array_is_list($data);

            $lines = [];
            foreach ($data as $key => $value) {
                $valueLiteral = $this->phpArrayLiteral($value, $indent + 1);
                $lines[] = $isList
                    ? "{$pad}{$valueLiteral}"
                    : "{$pad}" . $this->phpScalarLiteral((string) $key) . " => {$valueLiteral}";
            }

            return "[\n" . implode(",\n", $lines) . "\n{$closePad}]";
        }

        return $this->phpScalarLiteral($data);
    }

    /**
     * Render a scalar as a PHP literal, with proper backslash + quote escaping.
     */
    private function phpScalarLiteral($value): string
    {
        if (is_null($value)) {
            return 'null';
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (is_int($value) || is_float($value)) {
            return (string) $value;
        }

        $escaped = str_replace(['\\', "'"], ['\\\\', "\\'"], (string) $value);

        return "'{$escaped}'";
    }
}