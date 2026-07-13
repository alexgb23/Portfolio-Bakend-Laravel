<?php

namespace App\Filament\Resources\AvanceLaboratorios;

use App\Filament\Resources\AvanceLaboratorios\Pages\CreateAvanceLaboratorio;
use App\Filament\Resources\AvanceLaboratorios\Pages\EditAvanceLaboratorio;
use App\Filament\Resources\AvanceLaboratorios\Pages\ListAvanceLaboratorios;
use App\Filament\Resources\AvanceLaboratorios\Schemas\AvanceLaboratorioForm;
use App\Filament\Resources\AvanceLaboratorios\Tables\AvanceLaboratoriosTable;
use App\Models\AvanceLaboratorio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AvanceLaboratorioResource extends Resource
{
    protected static ?string $model = AvanceLaboratorio::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBarSquare;

    protected static ?string $recordTitleAttribute = 'titulo';

    protected static string|\UnitEnum|null $navigationGroup = 'Laboratorio';

    protected static ?string $navigationLabel = 'Avances';

    protected static ?string $modelLabel = 'Avance';

    protected static ?string $pluralModelLabel = 'Avances';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return AvanceLaboratorioForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AvanceLaboratoriosTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAvanceLaboratorios::route('/'),
            'create' => CreateAvanceLaboratorio::route('/create'),
            'edit' => EditAvanceLaboratorio::route('/{record}/edit'),
        ];
    }
}
