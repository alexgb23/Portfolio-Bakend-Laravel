<?php

namespace App\Filament\Resources\Projects\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class DocumentacionRelationManager extends RelationManager
{
    protected static string $relationship = 'documentacion';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información principal')
                    ->schema([
                        TextInput::make('titulo')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->maxLength(255),

                        TextInput::make('seccion')
                            ->label('Sección')
                            ->maxLength(255),

                        Select::make('tipo')
                            ->label('Tipo')
                            ->options([
                                'overview' => 'Overview',
                                'setup' => 'Setup',
                                'technical' => 'Technical',
                                'api' => 'API',
                                'notes' => 'Notes',
                                'faq' => 'FAQ',
                                'other' => 'Other',
                            ])
                            ->searchable()
                            ->native(false),
                    ])
                    ->columns(2),

                Section::make('Contenido')
                    ->schema([
                        Textarea::make('resumen')
                            ->label('Resumen')
                            ->rows(3)
                            ->columnSpanFull(),

                        Textarea::make('contenido')
                            ->label('Contenido')
                            ->rows(10)
                            ->columnSpanFull(),

                        TextInput::make('url_referencia')
                            ->label('URL de referencia')
                            ->url()
                            ->maxLength(2048)
                            ->columnSpanFull(),
                    ]),

                Section::make('Visibilidad')
                    ->schema([
                        TextInput::make('origen')
                            ->label('Origen')
                            ->required()
                            ->default('manual')
                            ->maxLength(255),

                        TextInput::make('orden')
                            ->label('Orden')
                            ->required()
                            ->numeric()
                            ->default(0),

                        Toggle::make('es_visible')
                            ->label('Visible')
                            ->default(true),

                        Toggle::make('es_destacado')
                            ->label('Destacado')
                            ->default(false),
                    ])
                    ->columns(2),

                Section::make('Metadata')
                    ->schema([
                        KeyValue::make('metadata')
                            ->label('Metadata')
                            ->keyLabel('Clave')
                            ->valueLabel('Valor')
                            ->addActionLabel('Añadir metadata')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titulo')
            ->defaultSort('orden')
            ->columns([
                TextColumn::make('orden')
                    ->label('Orden')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('seccion')
                    ->label('Sección')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->sortable(),

                IconColumn::make('es_visible')
                    ->label('Visible')
                    ->boolean(),

                IconColumn::make('es_destacado')
                    ->label('Destacado')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
