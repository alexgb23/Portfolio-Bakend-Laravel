<?php

namespace App\Filament\Resources\LaboratoryItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class LaboratoryItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información principal')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Select::make('item_type')
                            ->label('Tipo de item')
                            ->options([
                                'hardware' => 'Hardware',
                                'software' => 'Software',
                                'device' => 'Device',
                                'tool' => 'Tool',
                                'service' => 'Service',
                                'component' => 'Component',
                                'other' => 'Other',
                            ])
                            ->searchable()
                            ->native(false),

                        TextInput::make('category')
                            ->label('Categoría')
                            ->maxLength(255),

                        TextInput::make('location_name')
                            ->label('Ubicación')
                            ->maxLength(255),

                        Select::make('status')
                            ->label('Estado')
                            ->required()
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                                'testing' => 'Testing',
                                'maintenance' => 'Maintenance',
                                'archived' => 'Archived',
                            ])
                            ->default('active')
                            ->native(false),
                    ])
                    ->columns(2),

                Section::make('Detalle técnico')
                    ->schema([
                        Textarea::make('description')
                            ->label('Descripción')
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('technical_notes')
                            ->label('Notas técnicas')
                            ->rows(6)
                            ->columnSpanFull(),
                    ]),

                Section::make('Publicación')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Destacado')
                            ->default(false),

                        Toggle::make('is_visible')
                            ->label('Visible')
                            ->default(true),

                        TextInput::make('sort_order')
                            ->label('Orden')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }
}
