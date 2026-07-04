<?php

namespace App\Filament\Resources\HomeAssistantInstances\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HomeAssistantUseCasesRelationManager extends RelationManager
{
    protected static string $relationship = 'useCases';

    protected static ?string $title = 'Use cases';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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

                Toggle::make('is_featured')
                    ->label('Destacado')
                    ->default(false),

                Toggle::make('is_visible')
                    ->label('Visible')
                    ->default(true),

                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(4)
                    ->columnSpanFull(),

                TextInput::make('sort_order')
                    ->label('Orden')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ])
            ->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('category')
                    ->label('Categoría')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'gray',
                        'testing' => 'warning',
                        'archived' => 'danger',
                        default => 'gray',
                    }),

                IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean(),

                IconColumn::make('is_visible')
                    ->label('Visible')
                    ->boolean(),

                TextColumn::make('sort_order')
                    ->label('Orden')
                    ->numeric()
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }
}
