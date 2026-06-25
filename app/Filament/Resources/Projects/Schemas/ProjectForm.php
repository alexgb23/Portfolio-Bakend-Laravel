<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
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
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Textarea::make('short_description')
                            ->label('Descripción corta')
                            ->rows(3)
                            ->maxLength(280),

                        Textarea::make('description')
                            ->label('Descripción')
                            ->required()
                            ->rows(6)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Tecnología y enlaces')
                    ->schema([
                        TagsInput::make('technologies')
                            ->label('Tecnologías')
                            ->separator(','),

                        TextInput::make('stack_summary')
                            ->label('Resumen técnico')
                            ->maxLength(255),

                        TextInput::make('image_url')
                            ->label('URL de imagen')
                            ->url()
                            ->maxLength(2048),

                        TextInput::make('project_url')
                            ->label('URL del proyecto')
                            ->url()
                            ->maxLength(2048),

                        TextInput::make('repo_url')
                            ->label('URL del repositorio')
                            ->url()
                            ->maxLength(2048),
                    ])
                    ->columns(2),

                Section::make('Publicación')
                    ->schema([
                        Select::make('status')
                            ->required()
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->default('published'),

                        TextInput::make('sort_order')
                            ->label('Orden')
                            ->required()
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_featured')
                            ->label('Destacado')
                            ->default(false),

                        Toggle::make('is_published')
                            ->label('Publicado')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
