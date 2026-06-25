<?php

namespace App\Filament\Resources\ResearchSources\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ResearchSourceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Fuente')
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Select::make('source_type')
                            ->label('Tipo de fuente')
                            ->options([
                                'article' => 'Article',
                                'documentation' => 'Documentation',
                                'book' => 'Book',
                                'video' => 'Video',
                                'report' => 'Report',
                                'website' => 'Website',
                            ])
                            ->searchable()
                            ->native(false),

                        TextInput::make('topic')
                            ->label('Tema')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Publicación')
                    ->schema([
                        TextInput::make('author_name')
                            ->label('Autor')
                            ->maxLength(255),

                        TextInput::make('publisher_name')
                            ->label('Publisher')
                            ->maxLength(255),

                        DatePicker::make('published_on')
                            ->label('Fecha de publicación'),

                        TextInput::make('url')
                            ->label('URL')
                            ->url()
                            ->maxLength(2048),

                        TextInput::make('reference_code')
                            ->label('Código de referencia')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Resumen y notas')
                    ->schema([
                        Textarea::make('summary')
                            ->label('Resumen')
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('notes')
                            ->label('Notas')
                            ->rows(6)
                            ->columnSpanFull(),
                    ]),

                Section::make('Estado')
                    ->schema([
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
