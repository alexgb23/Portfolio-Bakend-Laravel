<?php

namespace App\Filament\Resources\HomeAssistantInstances\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class HomeAssistantInstanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Instancia')
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

                        TextInput::make('version')
                            ->label('Versión')
                            ->maxLength(255),

                        TextInput::make('location_name')
                            ->label('Ubicación')
                            ->maxLength(255),

                        TextInput::make('access_url')
                            ->label('URL de acceso')
                            ->url()
                            ->maxLength(2048),
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
