<?php

namespace App\Filament\Resources\ProyectoAdjuntos\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProyectoAdjuntoForm
{
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

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')
                    ->label('Proyecto')
                    ->relationship('project', 'title')
                    ->searchable()
                    ->native(false)
                    ->required(),

                TextInput::make('titulo')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),

                Select::make('tipo')
                    ->label('Tipo')
                    ->options(static::tipoOptions())
                    ->searchable()
                    ->native(false)
                    ->required()
                    ->default('link')
                    ->placeholder('Selecciona un tipo'),

                Select::make('grupo')
                    ->label('Grupo')
                    ->options(static::grupoOptions())
                    ->searchable()
                    ->native(false)
                    ->placeholder('Selecciona un grupo'),

                TextInput::make('subtitulo')
                    ->label('Subtítulo')
                    ->maxLength(255),

                Textarea::make('descripcion')
                    ->label('Descripción')
                    ->rows(4)
                    ->columnSpanFull(),

                Select::make('origen')
                    ->label('Origen')
                    ->options(static::origenOptions())
                    ->searchable()
                    ->native(false)
                    ->default('manual')
                    ->required()
                    ->placeholder('Selecciona el origen'),

                TextInput::make('nombre_archivo')
                    ->label('Nombre de archivo')
                    ->maxLength(255),

                Select::make('mime_type')
                    ->label('MIME type')
                    ->options(static::mimeTypeOptions())
                    ->searchable()
                    ->native(false)
                    ->placeholder('Selecciona un MIME type'),

                TextInput::make('url')
                    ->label('URL o ruta')
                    ->placeholder('https://ejemplo.com/recurso o /images/proyectos/mi-imagen.webp')
                    ->helperText('Puedes escribir una URL completa o una ruta del frontend.')
                    ->maxLength(2048)
                    ->columnSpanFull()
                    ->dehydrateStateUsing(fn($state) => filled($state) ? trim($state) : null)
                    ->rule('nullable')
                    ->rule('string')
                    ->rule('max:2048'),

                Select::make('icono')
                    ->label('Icono')
                    ->options(static::iconoOptions())
                    ->searchable()
                    ->native(false)
                    ->placeholder('Selecciona un icono'),

                TextInput::make('orden')
                    ->label('Orden')
                    ->required()
                    ->numeric()
                    ->default(0),

                Toggle::make('es_visible')
                    ->label('Visible')
                    ->default(true)
                    ->required(),

                Toggle::make('es_destacado')
                    ->label('Destacado')
                    ->default(false)
                    ->required(),

                KeyValue::make('metadata')
                    ->label('Metadata')
                    ->keyLabel('Clave')
                    ->valueLabel('Valor')
                    ->addActionLabel('Añadir metadata')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
