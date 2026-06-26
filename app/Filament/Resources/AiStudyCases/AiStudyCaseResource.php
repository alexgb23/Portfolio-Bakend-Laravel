<?php

namespace App\Filament\Resources\AiStudyCases;

use App\Filament\Resources\AiStudyCases\Pages\CreateAiStudyCase;
use App\Filament\Resources\AiStudyCases\Pages\EditAiStudyCase;
use App\Filament\Resources\AiStudyCases\Pages\ListAiStudyCases;
use App\Filament\Resources\AiStudyCases\Schemas\AiStudyCaseForm;
use App\Filament\Resources\AiStudyCases\Tables\AiStudyCasesTable;
use App\Models\AiStudyCase;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AiStudyCaseResource extends Resource
{
    protected static ?string $model = AiStudyCase::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationLabel = 'AI Study Cases';

    protected static ?string $modelLabel = 'AI Study Case';

    protected static ?string $pluralModelLabel = 'AI Study Cases';

    public static function form(Schema $schema): Schema
    {
        return AiStudyCaseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AiStudyCasesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAiStudyCases::route('/'),
            'create' => CreateAiStudyCase::route('/create'),
            'edit' => EditAiStudyCase::route('/{record}/edit'),
        ];
    }
}
