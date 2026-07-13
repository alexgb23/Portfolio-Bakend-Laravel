<?php

namespace App\Filament\Resources\ProyectoAdjuntos;

use App\Filament\Resources\ProyectoAdjuntos\Pages\CreateProyectoAdjunto;
use App\Filament\Resources\ProyectoAdjuntos\Pages\EditProyectoAdjunto;
use App\Filament\Resources\ProyectoAdjuntos\Pages\ListProyectoAdjuntos;
use App\Filament\Resources\ProyectoAdjuntos\Schemas\ProyectoAdjuntoForm;
use App\Filament\Resources\ProyectoAdjuntos\Tables\ProyectoAdjuntosTable;
use App\Models\ProyectoAdjunto;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProyectoAdjuntoResource extends Resource
{
    protected static ?string $model = ProyectoAdjunto::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPaperClip;

    protected static ?string $recordTitleAttribute = 'titulo';

    protected static string|\UnitEnum|null $navigationGroup = 'Proyectos';

    protected static ?string $navigationLabel = 'Adjuntos';

    protected static ?string $modelLabel = 'Adjunto';

    protected static ?string $pluralModelLabel = 'Adjuntos';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ProyectoAdjuntoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProyectoAdjuntosTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProyectoAdjuntos::route('/'),
            'create' => CreateProyectoAdjunto::route('/create'),
            'edit' => EditProyectoAdjunto::route('/{record}/edit'),
        ];
    }
}
