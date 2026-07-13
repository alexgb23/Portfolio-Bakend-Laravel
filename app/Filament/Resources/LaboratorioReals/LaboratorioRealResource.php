<?php

namespace App\Filament\Resources\LaboratorioReals;
use App\Filament\Resources\LaboratorioReals\RelationManagers;

use App\Filament\Resources\LaboratorioReals\Pages\CreateLaboratorioReal;
use App\Filament\Resources\LaboratorioReals\Pages\EditLaboratorioReal;
use App\Filament\Resources\LaboratorioReals\Pages\ListLaboratorioReals;
use App\Filament\Resources\LaboratorioReals\Schemas\LaboratorioRealForm;
use App\Filament\Resources\LaboratorioReals\Tables\LaboratorioRealsTable;
use App\Models\LaboratorioReal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LaboratorioRealResource extends Resource
{
    protected static ?string $model = LaboratorioReal::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'titulo';

    protected static string|\UnitEnum|null $navigationGroup = 'Laboratorio';

    protected static ?string $navigationLabel = 'Laboratorios';

    protected static ?string $modelLabel = 'Laboratorio';

    protected static ?string $pluralModelLabel = 'Laboratorios';

    protected static ?int $navigationSort = 0;


    public static function form(Schema $schema): Schema
    {
        return LaboratorioRealForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaboratorioRealsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DocumentacionRelationManager::class,
            RelationManagers\AvancesRelationManager::class,
            RelationManagers\AdjuntosRelationManager::class,
            RelationManagers\IdeasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLaboratorioReals::route('/'),
            'create' => CreateLaboratorioReal::route('/create'),
            'edit' => EditLaboratorioReal::route('/{record}/edit'),
        ];
    }
}
