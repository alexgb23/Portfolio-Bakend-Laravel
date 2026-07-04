<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Remitente')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Mensaje')
                    ->schema([
                        TextInput::make('subject')
                            ->label('Asunto')
                            ->maxLength(255),

                        Textarea::make('message')
                            ->label('Mensaje')
                            ->required()
                            ->rows(8)
                            ->columnSpanFull(),
                    ]),

                Section::make('Seguimiento')
                    ->schema([
                        Select::make('status')
                            ->label('Estado')
                            ->required()
                            ->options([
                                'new' => 'New',
                                'read' => 'Read',
                                'replied' => 'Replied',
                                'archived' => 'Archived',
                            ])
                            ->default('new')
                            ->native(false),

                        DateTimePicker::make('read_at')
                            ->label('Leído el'),
                    ])
                    ->columns(2),
            ]);
    }
}
