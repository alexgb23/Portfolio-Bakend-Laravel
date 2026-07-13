<?php

namespace App\Filament\Resources\AdjuntoLaboratorios;

use App\Filament\Resources\AdjuntoLaboratorios\Pages\CreateAdjuntoLaboratorio;
use App\Filament\Resources\AdjuntoLaboratorios\Pages\EditAdjuntoLaboratorio;
use App\Filament\Resources\AdjuntoLaboratorios\Pages\ListAdjuntoLaboratorios;
use App\Filament\Resources\AdjuntoLaboratorios\Schemas\AdjuntoLaboratorioForm;
use App\Filament\Resources\AdjuntoLaboratorios\Tables\AdjuntoLaboratoriosTable;
use App\Models\AdjuntoLaboratorio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AdjuntoLaboratorioResource extends Resource
{
    protected static ?string $model = AdjuntoLaboratorio::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPaperClip;

    protected static ?string $recordTitleAttribute = 'nombre_archivo';

    protected static string|\UnitEnum|null $navigationGroup = 'Laboratorios';

    protected static ?string $navigationLabel = 'Adjuntos';

    protected static ?string $modelLabel = 'Adjunto';

    protected static ?string $pluralModelLabel = 'Adjuntos';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return AdjuntoLaboratorioForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdjuntoLaboratoriosTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdjuntoLaboratorios::route('/'),
            'create' => CreateAdjuntoLaboratorio::route('/create'),
            'edit' => EditAdjuntoLaboratorio::route('/{record}/edit'),
        ];
    }
}
