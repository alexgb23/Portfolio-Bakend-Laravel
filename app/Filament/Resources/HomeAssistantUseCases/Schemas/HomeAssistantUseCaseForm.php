<?php

namespace App\Filament\Resources\HomeAssistantUseCases\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HomeAssistantUseCaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Caso de uso')
                    ->schema([
                        Select::make('home_assistant_instance_id')
                            ->label('Instancia')
                            ->relationship('instance', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255),

                        Select::make('category')
                            ->label('Categoría')
                            ->options([
                                'lighting' => 'Lighting',
                                'climate' => 'Climate',
                                'security' => 'Security',
                                'energy' => 'Energy',
                                'notifications' => 'Notifications',
                                'presence' => 'Presence',
                                'media' => 'Media',
                                'other' => 'Other',
                            ])
                            ->searchable()
                            ->native(false),

                        Select::make('status')
                            ->label('Estado')
                            ->required()
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                                'testing' => 'Testing',
                                'archived' => 'Archived',
                            ])
                            ->default('active')
                            ->native(false),
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
