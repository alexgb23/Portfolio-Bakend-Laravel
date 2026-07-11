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

class SeccionesRelationManager extends RelationManager
{
    protected static string $relationship = 'secciones';

    protected static ?string $title = 'Secciones';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('clave')
                    ->label('Clave')
                    ->helperText('Ejemplo: resumen, retos, solucion, resultados')
                    ->maxLength(255),

                TextInput::make('titulo')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),

                Select::make('tipo_contenido')
                    ->label('Tipo de contenido')
                    ->options([
                        'texto' => 'Texto',
                        'markdown' => 'Markdown',
                        'lista' => 'Lista',
                        'codigo' => 'Código',
                        'media' => 'Media',
                        'mixto' => 'Mixto',
                    ])
                    ->default('texto')
                    ->required()
                    ->searchable()
                    ->native(false),

                Select::make('layout')
                    ->label('Layout')
                    ->options([
                        'default' => 'Default',
                        'full' => 'Full width',
                        'split' => 'Split',
                        'grid' => 'Grid',
                        'highlight' => 'Highlight',
                    ])
                    ->default('full')
                    ->searchable()
                    ->native(false),

                Textarea::make('resumen')
                    ->label('Resumen')
                    ->rows(3)
                    ->columnSpanFull(),

                Textarea::make('contenido')
                    ->label('Contenido')
                    ->rows(10)
                    ->columnSpanFull(),

                KeyValue::make('items')
                    ->label('Items')
                    ->keyLabel('Clave')
                    ->valueLabel('Valor')
                    ->addActionLabel('Añadir item')
                    ->helperText('Opcional. Úsalo solo si esta sección necesita datos adicionales tipo lista o pares clave/valor.')
                    ->columnSpanFull(),

                TextInput::make('media_url')
                    ->label('Media URL')
                    ->url()
                    ->maxLength(2048)
                    ->columnSpanFull(),

                TextInput::make('codigo_lenguaje')
                    ->label('Lenguaje de código')
                    ->maxLength(100),

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

                KeyValue::make('metadata')
                    ->label('Metadata')
                    ->keyLabel('Clave')
                    ->valueLabel('Valor')
                    ->addActionLabel('Añadir metadata')
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
                TextColumn::make('orden')
                    ->label('Orden')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('clave')
                    ->label('Clave')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('tipo_contenido')
                    ->label('Tipo')
                    ->badge()
                    ->sortable(),

                TextColumn::make('layout')
                    ->label('Layout')
                    ->badge()
                    ->toggleable(),

                TextColumn::make('resumen')
                    ->label('Resumen')
                    ->limit(80)
                    ->wrap()
                    ->placeholder('—')
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
