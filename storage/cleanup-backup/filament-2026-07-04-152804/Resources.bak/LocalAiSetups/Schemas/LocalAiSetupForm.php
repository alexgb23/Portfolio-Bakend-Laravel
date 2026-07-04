<?php

namespace App\Filament\Resources\LocalAiSetups\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class LocalAiSetupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identidad')
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
                    ])
                    ->columns(2),

                Section::make('Stack y modelo')
                    ->schema([
                        Select::make('provider')
                            ->label('Proveedor')
                            ->options([
                                'ollama' => 'Ollama',
                                'localai' => 'LocalAI',
                                'open-webui' => 'Open WebUI',
                                'lm-studio' => 'LM Studio',
                                'custom' => 'Custom',
                            ])
                            ->searchable()
                            ->native(false),

                        TextInput::make('model_name')
                            ->label('Modelo')
                            ->maxLength(255),

                        TextInput::make('model_size')
                            ->label('Tamaño del modelo')
                            ->maxLength(255),

                        TextInput::make('interface_name')
                            ->label('Interfaz')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Conectividad y notas')
                    ->schema([
                        TextInput::make('base_url')
                            ->label('Base URL')
                            ->url()
                            ->maxLength(2048),

                        Textarea::make('description')
                            ->label('Descripción')
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('hardware_notes')
                            ->label('Notas de hardware')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),

                Section::make('Publicación')
                    ->schema([
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
