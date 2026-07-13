<?php

namespace App\Filament\Resources\ProyectoDocumentacions;

use App\Filament\Resources\ProyectoDocumentacions\Pages\CreateProyectoDocumentacion;
use App\Filament\Resources\ProyectoDocumentacions\Pages\EditProyectoDocumentacion;
use App\Filament\Resources\ProyectoDocumentacions\Pages\ListProyectoDocumentacions;
use App\Filament\Resources\ProyectoDocumentacions\Schemas\ProyectoDocumentacionForm;
use App\Filament\Resources\ProyectoDocumentacions\Tables\ProyectoDocumentacionsTable;
use App\Models\ProyectoDocumentacion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProyectoDocumentacionResource extends Resource
{
    protected static ?string $model = ProyectoDocumentacion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $recordTitleAttribute = 'titulo';

    protected static string|\UnitEnum|null $navigationGroup = 'Proyectos';

    protected static ?string $navigationParentItem = 'Proyectos';

    protected static ?string $navigationLabel = 'Documentación';

    protected static ?string $modelLabel = 'Documento';

    protected static ?string $pluralModelLabel = 'Documentación';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ProyectoDocumentacionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProyectoDocumentacionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProyectoDocumentacions::route('/'),
            'create' => CreateProyectoDocumentacion::route('/create'),
            'edit' => EditProyectoDocumentacion::route('/{record}/edit'),
        ];
    }
}
