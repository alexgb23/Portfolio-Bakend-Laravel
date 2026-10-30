<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DatabaseAuditController extends Controller
{
    public function __invoke(Request $request)
    {
        $tables = collect(Schema::getTables())
            ->map(fn ($table) => $table['name'] ?? $table['tablename'] ?? null)
            ->filter()
            ->sort()
            ->values();

        $relevantTables = $tables->filter(
            fn ($table) => ! str_starts_with($table, 'cache')
                && ! str_starts_with($table, 'jobs')
                && ! str_starts_with($table, 'migrations')
                && ! str_starts_with($table, 'personal_access_tokens')
        );

        $schema = [];

        foreach ($relevantTables as $table) {
            $schema[$table] = [
                'columns' => collect(Schema::getColumns($table))
                    ->map(fn ($column) => [
                        'name' => $column['name'],
                        'type' => $column['type_name'] ?? $column['type'] ?? null,
                        'nullable' => $column['nullable'] ?? null,
                        'default' => $column['default'] ?? null,
                    ])
                    ->values(),

                'indexes' => collect(Schema::getIndexes($table))
                    ->map(fn ($index) => [
                        'name' => $index['name'],
                        'columns' => $index['columns'],
                        'unique' => $index['unique'] ?? false,
                    ])
                    ->values(),

                'foreign_keys' => collect(Schema::getForeignKeys($table))
                    ->map(fn ($fk) => [
                        'name' => $fk['name'] ?? null,
                        'columns' => $fk['columns'] ?? [],
                        'foreign_table' => $fk['foreign_table'] ?? null,
                        'foreign_columns' => $fk['foreign_columns'] ?? [],
                    ])
                    ->values(),
            ];
        }

        return response()->json([
            'database' => config('database.default'),
            'tables' => $tables,
            'schema' => $schema,
        ]);
    }
}
