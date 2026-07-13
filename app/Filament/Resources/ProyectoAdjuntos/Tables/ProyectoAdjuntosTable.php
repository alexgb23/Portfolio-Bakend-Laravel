<?php

namespace App\Filament\Resources\ProyectoAdjuntos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProyectoAdjuntosTable
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

    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('orden')
            ->columns([
                TextColumn::make('project.title')
                    ->label('Proyecto')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn($state) => static::tipoOptions()[$state] ?? $state)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('grupo')
                    ->label('Grupo')
                    ->formatStateUsing(fn($state) => static::grupoOptions()[$state] ?? $state)
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('subtitulo')
                    ->label('Subtítulo')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('origen')
                    ->label('Origen')
                    ->formatStateUsing(fn($state) => static::origenOptions()[$state] ?? $state)
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
                    ->limit(60)
                    ->tooltip(fn($record) => $record->url)
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('icono')
                    ->label('Icono')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('orden')
                    ->label('Orden')
                    ->numeric()
                    ->sortable(),

                IconColumn::make('es_visible')
                    ->label('Visible')
                    ->boolean(),

                IconColumn::make('es_destacado')
                    ->label('Destacado')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
