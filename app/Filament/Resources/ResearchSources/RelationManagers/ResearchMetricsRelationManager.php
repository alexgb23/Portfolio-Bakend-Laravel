<?php

namespace App\Filament\Resources\ResearchSources\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ResearchMetricsRelationManager extends RelationManager
{
    protected static string $relationship = 'metrics';

    protected static ?string $title = 'Metrics';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('metric_name')
                    ->label('Métrica')
                    ->required()
                    ->maxLength(255),

                TextInput::make('metric_value')
                    ->label('Valor')
                    ->required()
                    ->maxLength(255),

                TextInput::make('metric_unit')
                    ->label('Unidad')
                    ->maxLength(255),

                DatePicker::make('measured_on')
                    ->label('Fecha de medición'),

                Select::make('status')
                    ->label('Estado')
                    ->required()
                    ->options([
                        'active' => 'Active',
                        'draft' => 'Draft',
                        'archived' => 'Archived',
                    ])
                    ->default('active')
                    ->native(false),

                Toggle::make('is_featured')
                    ->label('Destacado')
                    ->default(false),

                Textarea::make('notes')
                    ->label('Notas')
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
            ->recordTitleAttribute('metric_name')
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('metric_name')
                    ->label('Métrica')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('metric_value')
                    ->label('Valor')
                    ->searchable(),

                TextColumn::make('metric_unit')
                    ->label('Unidad')
                    ->toggleable(),

                TextColumn::make('measured_on')
                    ->label('Medido el')
                    ->date()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'draft' => 'warning',
                        'archived' => 'danger',
                        default => 'gray',
                    }),

                IconColumn::make('is_featured')
                    ->label('Destacado')
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
