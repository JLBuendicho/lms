<?php

namespace App\Filament\Resources\Subjects\Schemas;

use App\Models\Subjects;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubjectsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('color')
                    ->options(
                        collect(Subjects::COLORS)->mapWithKeys(fn(string $rgb, string $name) => [
                            $name => '
                                <div class="flex items-center gap-2">
                                    <span class="inline-block h-4 w-4 rounded-full border border-gray-300"
                                        style="background-color: ' . e($rgb) . '"></span>
                                    <span>' . e(ucfirst($name)) . '</span>
                                </div>
                            ',
                        ])->all()
                    )
                    ->allowHtml()
                    ->searchable(),
            ]);
    }
}
