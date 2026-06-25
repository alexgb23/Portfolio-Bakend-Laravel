<?php

namespace App\Filament\Resources\LaboratoryBlocks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class LaboratoryBlockForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identidad del bloque')
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

                        TextInput::make('block_key')
                            ->label('Clave interna')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('kicker')
                            ->label('Kicker')
                            ->maxLength(255),

                        TextInput::make('title')
                            ->label('Título')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Contenido y layout')
                    ->schema([
                        Textarea::make('description')
                            ->label('Descripción')
                            ->rows(5)
                            ->columnSpanFull(),

                        Select::make('layout_type')
                            ->label('Tipo de layout')
                            ->options([
                                'grid' => 'Grid',
                                'list' => 'List',
                                'hero' => 'Hero',
                                'cards' => 'Cards',
                                'feature' => 'Feature',
                                'custom' => 'Custom',
                            ])
                            ->searchable()
                            ->native(false),

                        Select::make('status')
                            ->label('Estado')
                            ->required()
                            ->options([
                                'active' => 'Active',
                                'draft' => 'Draft',
                                'archived' => 'Archived',
                            ])
                            ->default('active')
                            ->native(false),
                    ])
                    ->columns(2),

                Section::make('Publicación')
                    ->schema([
                        Toggle::make('is_visible')
                            ->label('Visible')
                            ->default(true),

                        Toggle::make('is_featured')
                            ->label('Destacado')
                            ->default(false),

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
