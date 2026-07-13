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
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class DocumentacionRelationManager extends RelationManager
{
    protected static string $relationship = 'documentacion';

    protected static ?string $title = 'Documentación';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id')
                    ->label('ID')
                    ->helperText('Identificador interno del registro.')
                    ->disabled()
                    ->dehydrated(false)
                    ->visible(fn($record) => $record !== null),

                TextInput::make('titulo')
                    ->label('Título')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Nombre principal del bloque de documentación.')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->label('Slug')
                    ->maxLength(255)
                    ->helperText('Versión legible para URL o identificador interno.'),

                TextInput::make('seccion')
                    ->label('Sección')
                    ->maxLength(255)
                    ->placeholder('overview, arquitectura, api...')
                    ->helperText('Parte del proyecto a la que pertenece esta documentación.'),

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
                    ->native(false)
                    ->helperText('Clasifica el tipo de documentación para organizarla mejor.'),

                Textarea::make('resumen')
                    ->label('Resumen')
                    ->rows(3)
                    ->helperText('Descripción breve para entender rápido de qué trata.')
                    ->columnSpanFull(),

                Textarea::make('contenido')
                    ->label('Contenido')
                    ->rows(10)
                    ->helperText('Texto principal de la documentación.')
                    ->columnSpanFull(),

                TextInput::make('url_referencia')
                    ->label('URL de referencia')
                    ->url()
                    ->maxLength(2048)
                    ->placeholder('https://...')
                    ->helperText('Enlace externo de apoyo o fuente relacionada.')
                    ->columnSpanFull(),

                TextInput::make('origen')
                    ->label('Origen')
                    ->required()
                    ->default('manual')
                    ->maxLength(255)
                    ->placeholder('manual, importado, ia...')
                    ->helperText('Indica cómo se creó este registro.'),

                TextInput::make('orden')
                    ->label('Orden')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->helperText('Sirve para ordenar visualmente la documentación.'),

                Toggle::make('es_visible')
                    ->label('Visible')
                    ->default(true)
                    ->helperText('Actívalo si este contenido debe mostrarse normalmente.'),

                Toggle::make('es_destacado')
                    ->label('Destacado')
                    ->default(false)
                    ->helperText('Úsalo para resaltar una pieza importante.'),

                KeyValue::make('metadata')
                    ->label('Metadata')
                    ->keyLabel('Clave')
                    ->valueLabel('Valor')
                    ->addActionLabel('Añadir metadata')
                    ->helperText('Datos extra opcionales en formato clave/valor.')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titulo')
            ->defaultSort('orden')
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('orden')
                    ->label('Orden')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('seccion')
                    ->label('Sección')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->sortable(),

                TextColumn::make('origen')
                    ->label('Origen')
                    ->searchable()
                    ->toggleable(),

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
