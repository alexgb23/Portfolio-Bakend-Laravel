<?php

namespace App\Filament\Resources\IdeaLaboratorios;

use App\Filament\Resources\IdeaLaboratorios\Pages\CreateIdeaLaboratorio;
use App\Filament\Resources\IdeaLaboratorios\Pages\EditIdeaLaboratorio;
use App\Filament\Resources\IdeaLaboratorios\Pages\ListIdeaLaboratorios;
use App\Filament\Resources\IdeaLaboratorios\Schemas\IdeaLaboratorioForm;
use App\Filament\Resources\IdeaLaboratorios\Tables\IdeaLaboratoriosTable;
use App\Models\IdeaLaboratorio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class IdeaLaboratorioResource extends Resource
{
    protected static ?string $model = IdeaLaboratorio::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLightBulb;

    protected static ?string $recordTitleAttribute = 'titulo';

    protected static string|\UnitEnum|null $navigationGroup = 'Laboratorio';

    protected static ?string $navigationLabel = 'Ideas';

    protected static ?string $modelLabel = 'Idea';

    protected static ?string $pluralModelLabel = 'Ideas';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return IdeaLaboratorioForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IdeaLaboratoriosTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIdeaLaboratorios::route('/'),
            'create' => CreateIdeaLaboratorio::route('/create'),
            'edit' => EditIdeaLaboratorio::route('/{record}/edit'),
        ];
    }
}
