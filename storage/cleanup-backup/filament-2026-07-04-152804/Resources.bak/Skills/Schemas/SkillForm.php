<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SkillForm
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

                        Select::make('category')
                            ->label('Categoría')
                            ->options([
                                'backend' => 'Backend',
                                'frontend' => 'Frontend',
                                'devops' => 'DevOps',
                                'networking' => 'Networking',
                                'virtualization' => 'Virtualization',
                                'automation' => 'Automation',
                                'ai' => 'AI',
                                'database' => 'Database',
                                'security' => 'Security',
                                'other' => 'Other',
                            ])
                            ->searchable()
                            ->native(false),

                        Select::make('proficiency_level')
                            ->label('Nivel')
                            ->options([
                                'beginner' => 'Beginner',
                                'intermediate' => 'Intermediate',
                                'advanced' => 'Advanced',
                                'expert' => 'Expert',
                            ])
                            ->searchable()
                            ->native(false),

                        TextInput::make('proficiency_score')
                            ->label('Puntuación')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(5),

                        TextInput::make('icon_name')
                            ->label('Icono')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Descripción')
                    ->schema([
                        Textarea::make('description')
                            ->label('Descripción')
                            ->rows(5)
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
