<?php

namespace App\Filament\Resources\ProfileSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProfileSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identidad')
                    ->schema([
                        TextInput::make('full_name')
                            ->label('Nombre completo')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('display_name')
                            ->label('Nombre visible')
                            ->maxLength(255),

                        TextInput::make('headline')
                            ->label('Headline')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('subheadline')
                            ->label('Subheadline')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Biografía')
                    ->schema([
                        Textarea::make('bio_short')
                            ->label('Bio corta')
                            ->rows(3)
                            ->columnSpanFull(),

                        Textarea::make('bio_long')
                            ->label('Bio larga')
                            ->rows(8)
                            ->columnSpanFull(),
                    ]),

                Section::make('Datos públicos')
                    ->schema([
                        TextInput::make('location')
                            ->label('Ubicación')
                            ->maxLength(255),

                        TextInput::make('email_public')
                            ->label('Email público')
                            ->email()
                            ->maxLength(255),

                        TextInput::make('website_url')
                            ->label('Web')
                            ->url()
                            ->maxLength(2048),

                        TextInput::make('resume_url')
                            ->label('CV URL')
                            ->url()
                            ->maxLength(2048),
                    ])
                    ->columns(2),

                Section::make('Estado')
                    ->schema([
                        TextInput::make('status_label')
                            ->label('Texto de estado')
                            ->maxLength(255),

                        Toggle::make('is_active')
                            ->label('Activo')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
