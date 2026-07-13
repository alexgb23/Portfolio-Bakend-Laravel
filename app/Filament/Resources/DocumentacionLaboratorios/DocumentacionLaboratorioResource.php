<?php

namespace App\Filament\Resources\DocumentacionLaboratorios;

use App\Filament\Resources\DocumentacionLaboratorios\Pages\CreateDocumentacionLaboratorio;
use App\Filament\Resources\DocumentacionLaboratorios\Pages\EditDocumentacionLaboratorio;
use App\Filament\Resources\DocumentacionLaboratorios\Pages\ListDocumentacionLaboratorios;
use App\Filament\Resources\DocumentacionLaboratorios\Schemas\DocumentacionLaboratorioForm;
use App\Filament\Resources\DocumentacionLaboratorios\Tables\DocumentacionLaboratoriosTable;
use App\Models\DocumentacionLaboratorio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DocumentacionLaboratorioResource extends Resource
{
    protected static ?string $model = DocumentacionLaboratorio::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $recordTitleAttribute = 'titulo';

    protected static string|\UnitEnum|null $navigationGroup = 'Laboratorios';

    protected static ?string $navigationLabel = 'Documentación';

    protected static ?string $modelLabel = 'Documento';

    protected static ?string $pluralModelLabel = 'Documentación';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return DocumentacionLaboratorioForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DocumentacionLaboratoriosTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDocumentacionLaboratorios::route('/'),
            'create' => CreateDocumentacionLaboratorio::route('/create'),
            'edit' => EditDocumentacionLaboratorio::route('/{record}/edit'),
        ];
    }
}
