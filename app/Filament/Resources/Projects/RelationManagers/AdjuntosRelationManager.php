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
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AdjuntosRelationManager extends RelationManager
{
    protected static string $relationship = 'adjuntos';

    protected static ?string $title = 'Adjuntos';

    protected static function tipoOptions(): array
    {
        return [
            'demo' => 'Demo',
            'repo' => 'Repositorio',
            'doc' => 'Documento',
            'file' => 'Archivo',
            'link' => 'Enlace',
            'image' => 'Imagen',
            'video' => 'Vídeo',
            'other' => 'Otro',
        ];
    }

    protected static function urlOptions(): array
    {
        return [
            '/backendDarkAvif.avif' => '/backendDarkAvif.avif',
            '/backendDarkWebp.webp' => '/backendDarkWebp.webp',
        ];
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id')
                    ->label('ID')
                    ->helperText('Identificador interno del adjunto.')
                    ->disabled()
                    ->dehydrated(false)
                    ->visible(fn($record) => $record !== null),

                TextInput::make('titulo')
                    ->label('Título')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Nombre principal con el que reconocerás este adjunto.'),

                Select::make('tipo')
                    ->label('Tipo')
                    ->options(static::tipoOptions())
                    ->searchable()
                    ->native(false)
                    ->required()
                    ->allowHtml(false)
                    ->placeholder('Selecciona un tipo')
                    ->helperText('Clasifica el adjunto: repositorio, demo, documento, imagen, vídeo, etc.'),

                TextInput::make('grupo')
                    ->label('Grupo')
                    ->maxLength(255)
                    ->placeholder('frontend, backend, despliegue...')
                    ->helperText('Agrupa adjuntos parecidos dentro del proyecto.'),

                TextInput::make('subtitulo')
                    ->label('Subtítulo')
                    ->maxLength(255)
                    ->helperText('Texto secundario opcional para dar más contexto.'),

                Textarea::make('descripcion')
                    ->label('Descripción')
                    ->rows(4)
                    ->helperText('Explica qué contiene o para qué sirve este adjunto.')
                    ->columnSpanFull(),

                Select::make('url_predefinida')
                    ->label('URL predefinida')
                    ->options(static::urlOptions())
                    ->searchable()
                    ->native(false)
                    ->dehydrated(false)
                    ->placeholder('Selecciona una ruta predefinida')
                    ->helperText('Atajo para rellenar la URL con rutas ya conocidas.')
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (filled($state)) {
                            $set('url', trim($state));
                        }
                    }),

                TextInput::make('url')
                    ->label('URL o ruta')
                    ->placeholder('https://ejemplo.com/recurso o /backendDarkAvif.avif')
                    ->helperText('Acepta URLs completas o rutas locales que empiecen por /.')
                    ->maxLength(2048)
                    ->columnSpanFull()
                    ->dehydrateStateUsing(fn($state) => filled($state) ? trim($state) : null)
                    ->rule('nullable')
                    ->rule('string')
                    ->rule('max:2048'),

                TextInput::make('nombre_archivo')
                    ->label('Nombre de archivo')
                    ->maxLength(255)
                    ->helperText('Nombre físico o lógico del archivo, si aplica.'),

                TextInput::make('mime_type')
                    ->label('MIME type')
                    ->maxLength(255)
                    ->placeholder('image/png, application/pdf...')
                    ->helperText('Tipo técnico del archivo. Útil para diferenciar imágenes, PDFs, vídeos, etc.'),

                TextInput::make('icono')
                    ->label('Icono')
                    ->maxLength(100)
                    ->helperText('Nombre del icono si usas uno para representarlo visualmente.'),

                TextInput::make('origen')
                    ->label('Origen')
                    ->required()
                    ->default('manual')
                    ->maxLength(255)
                    ->placeholder('manual, importado, ia...')
                    ->helperText('Indica de dónde salió este registro.'),

                TextInput::make('orden')
                    ->label('Orden')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->helperText('Sirve para ordenar los adjuntos. Menor número = aparece antes.'),

                Toggle::make('es_visible')
                    ->label('Visible')
                    ->default(true)
                    ->helperText('Actívalo si este adjunto debe mostrarse normalmente.'),

                Toggle::make('es_destacado')
                    ->label('Destacado')
                    ->default(false)
                    ->helperText('Marca este adjunto si quieres resaltarlo sobre el resto.'),

                KeyValue::make('metadata')
                    ->label('Metadata')
                    ->keyLabel('Clave')
                    ->valueLabel('Valor')
                    ->addActionLabel('Añadir metadata')
                    ->helperText('Datos extra opcionales en pares clave/valor.')
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

                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn($state) => static::tipoOptions()[$state] ?? $state)
                    ->sortable(),

                TextColumn::make('grupo')
                    ->label('Grupo')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('nombre_archivo')
                    ->label('Archivo')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('mime_type')
                    ->label('MIME')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('url')
                    ->label('URL')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->url)
                    ->toggleable(),

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
