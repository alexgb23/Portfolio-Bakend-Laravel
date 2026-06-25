<?php

namespace App\Filament\Resources\LabCapabilities\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class LabCapabilityForm
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
                                'virtualization' => 'Virtualization',
                                'networking' => 'Networking',
                                'automation' => 'Automation',
                                'ai' => 'AI',
                                'monitoring' => 'Monitoring',
                                'security' => 'Security',
                                'infrastructure' => 'Infrastructure',
                                'other' => 'Other',
                            ])
                            ->searchable()
                            ->native(false),

                        Select::make('capability_level')
                            ->label('Nivel')
                            ->options([
                                'basic' => 'Basic',
                                'intermediate' => 'Intermediate',
                                'advanced' => 'Advanced',
                            ])
                            ->searchable()
                            ->native(false),

                        Select::make('status')
                            ->label('Estado')
                            ->required()
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                                'draft' => 'Draft',
                                'archived' => 'Archived',
                            ])
                            ->default('active')
                            ->native(false),
                    ])
                    ->columns(2),

                Section::make('Descripción técnica')
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
