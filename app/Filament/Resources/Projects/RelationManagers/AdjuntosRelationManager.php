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

    protected static function grupoOptions(): array
    {
        return [
            'general' => 'General',
            'frontend' => 'Frontend',
            'backend' => 'Backend',
            'api' => 'API',
            'infraestructura' => 'Infraestructura',
            'deploy' => 'Deploy',
            'documentacion' => 'Documentación',
            'assets' => 'Assets',
            'monitorizacion' => 'Monitorización',
            'seguridad' => 'Seguridad',
        ];
    }

    protected static function origenOptions(): array
    {
        return [
            'manual' => 'Manual',
            'importado' => 'Importado',
            'ia' => 'IA',
            'generado' => 'Generado',
            'scraping' => 'Scraping',
            'externo' => 'Externo',
        ];
    }

    protected static function mimeTypeOptions(): array
    {
        return [
            'application/json' => 'application/json',
            'application/pdf' => 'application/pdf',
            'text/plain' => 'text/plain',
            'text/html' => 'text/html',
            'image/png' => 'image/png',
            'image/jpeg' => 'image/jpeg',
            'image/webp' => 'image/webp',
            'image/avif' => 'image/avif',
            'video/mp4' => 'video/mp4',
            'application/zip' => 'application/zip',
        ];
    }

    protected static function iconoOptions(): array
    {
        return [
            'heroicon-o-link' => 'Enlace',
            'heroicon-o-document-text' => 'Documento',
            'heroicon-o-code-bracket' => 'Código',
            'heroicon-o-photo' => 'Imagen',
            'heroicon-o-film' => 'Vídeo',
            'heroicon-o-archive-box' => 'Archivo',
            'heroicon-o-server' => 'Servidor',
            'heroicon-o-globe-alt' => 'Web',
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
                    ->placeholder('Selecciona un tipo')
                    ->helperText('Clasifica el adjunto: repositorio, demo, documento, imagen, vídeo, etc.'),

                Select::make('grupo')
                    ->label('Grupo')
                    ->options(static::grupoOptions())
                    ->searchable()
                    ->native(false)
                    ->placeholder('Selecciona un grupo')
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

                TextInput::make('url')
                    ->label('URL o ruta')
                    ->placeholder('https://ejemplo.com/recurso o /images/proyectos/mi-imagen.webp')
                    ->helperText('Escribe una URL completa o una ruta del frontend. No está limitada a valores predefinidos.')
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

                Select::make('mime_type')
                    ->label('MIME type')
                    ->options(static::mimeTypeOptions())
                    ->searchable()
                    ->native(false)
                    ->placeholder('Selecciona un MIME type')
                    ->helperText('Tipo técnico del archivo. Útil para diferenciar imágenes, PDFs, vídeos, etc.'),

                Select::make('icono')
                    ->label('Icono')
                    ->options(static::iconoOptions())
                    ->searchable()
                    ->native(false)
                    ->placeholder('Selecciona un icono')
                    ->helperText('Nombre del icono para representarlo visualmente.'),

                Select::make('origen')
                    ->label('Origen')
                    ->options(static::origenOptions())
                    ->default('manual')
                    ->searchable()
                    ->native(false)
                    ->required()
                    ->placeholder('Selecciona el origen')
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
                    ->formatStateUsing(fn($state) => static::grupoOptions()[$state] ?? $state)
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
                    ->formatStateUsing(fn($state) => static::origenOptions()[$state] ?? $state)
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
