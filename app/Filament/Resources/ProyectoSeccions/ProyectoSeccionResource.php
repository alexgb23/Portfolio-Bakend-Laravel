<?php

namespace App\Filament\Resources\ProyectoSeccions;

use App\Filament\Resources\ProyectoSeccions\Pages\CreateProyectoSeccion;
use App\Filament\Resources\ProyectoSeccions\Pages\EditProyectoSeccion;
use App\Filament\Resources\ProyectoSeccions\Pages\ListProyectoSeccions;
use App\Filament\Resources\ProyectoSeccions\Schemas\ProyectoSeccionForm;
use App\Filament\Resources\ProyectoSeccions\Tables\ProyectoSeccionsTable;
use App\Models\ProyectoSeccion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProyectoSeccionResource extends Resource
{
    protected static ?string $model = ProyectoSeccion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQueueList;

    protected static ?string $recordTitleAttribute = 'titulo';

    protected static string|\UnitEnum|null $navigationGroup = 'Proyectos';

    protected static ?string $navigationParentItem = 'Proyectos';

    protected static ?string $navigationLabel = 'Secciones';

    protected static ?string $modelLabel = 'Sección';

    protected static ?string $pluralModelLabel = 'Secciones';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return ProyectoSeccionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProyectoSeccionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProyectoSeccions::route('/'),
            'create' => CreateProyectoSeccion::route('/create'),
            'edit' => EditProyectoSeccion::route('/{record}/edit'),
        ];
    }
}
