<?php

namespace App\Filament\Resources\LaboratorioReals\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                    ->helperText('Identificador interno del registro en la base de datos.')
                    ->disabled()
                    ->dehydrated(false)
                    ->visible(fn($record) => $record !== null),

                TextInput::make('fase')
                    ->label('Fase')
                    ->placeholder('investigación, desarrollo, validación...')
                    ->helperText('Etapa del laboratorio a la que pertenece este contenido.'),

                TextInput::make('seccion')
                    ->label('Sección')
                    ->placeholder('backend, IA, interfaz, documentación...')
                    ->helperText('Bloque temático o parte del proyecto a la que hace referencia.'),

                TextInput::make('tipo_documentacion')
                    ->label('Tipo de documentación')
                    ->placeholder('guía, análisis, memoria, especificación...')
                    ->helperText('Clasifica el tipo de documento para encontrarlo más rápido.'),

                TextInput::make('titulo')
                    ->label('Título')
                    ->required()
                    ->helperText('Nombre principal del documento o entrada de documentación.'),

                Textarea::make('resumen')
                    ->label('Resumen')
                    ->helperText('Descripción breve para entender de qué trata sin abrir el contenido completo.')
                    ->columnSpanFull(),

                Textarea::make('contenido')
                    ->label('Contenido')
                    ->helperText('Texto principal de la documentación.')
                    ->columnSpanFull(),

                TagsInput::make('urls_relacionadas')
                    ->label('URLs relacionadas')
                    ->helperText('Enlaces asociados a este contenido, uno por elemento.'),

                TextInput::make('orden')
                    ->label('Orden')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->helperText('Sirve para ordenar visualmente los registros. Menor número = aparece antes.'),

                TextInput::make('estado')
                    ->label('Estado')
                    ->required()
                    ->default('borrador')
                    ->placeholder('borrador, publicado, revisado...')
                    ->helperText('Situación actual del documento dentro de tu flujo de trabajo.'),

                Toggle::make('es_visible')
                    ->label('Visible')
                    ->required()
                    ->helperText('Actívalo si quieres que este contenido se considere visible.'),

                TextInput::make('origen')
                    ->label('Origen')
                    ->required()
                    ->default('manual')
                    ->placeholder('manual, importado, ia...')
                    ->helperText('Indica de dónde salió este registro.'),

                Textarea::make('metadata')
                    ->label('Metadata')
                    ->helperText('Datos extra en formato libre o JSON, solo si realmente los necesitas.')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titulo')
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('titulo')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('fase')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('seccion')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('tipo_documentacion')
                    ->label('Tipo')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('estado')
                    ->searchable()
                    ->sortable(),

                IconColumn::make('es_visible')
                    ->boolean(),

                TextColumn::make('orden')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('origen')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
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
