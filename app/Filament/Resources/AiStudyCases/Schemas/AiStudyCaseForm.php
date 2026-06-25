<?php

namespace App\Filament\Resources\AiStudyCases\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AiStudyCaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información principal')
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

                        Select::make('category')
                            ->label('Categoría')
                            ->options([
                                'automation' => 'Automation',
                                'llm' => 'LLM',
                                'rag' => 'RAG',
                                'agent' => 'Agent',
                                'integration' => 'Integration',
                                'infrastructure' => 'Infrastructure',
                                'other' => 'Other',
                            ])
                            ->searchable()
                            ->native(false),

                        TextInput::make('technology_stack')
                            ->label('Stack tecnológico')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Caso de estudio')
                    ->schema([
                        Textarea::make('context')
                            ->label('Contexto')
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('challenge')
                            ->label('Reto')
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('solution')
                            ->label('Solución')
                            ->rows(5)
                            ->columnSpanFull(),

                        Textarea::make('results')
                            ->label('Resultados')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Section::make('Publicación')
                    ->schema([
                        Select::make('status')
                            ->label('Estado')
                            ->required()
                            ->options([
                                'published' => 'Published',
                                'draft' => 'Draft',
                                'archived' => 'Archived',
                            ])
                            ->default('published')
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
