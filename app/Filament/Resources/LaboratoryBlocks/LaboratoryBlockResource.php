<?php

namespace App\Filament\Resources\LaboratoryBlocks;

use App\Filament\Resources\LaboratoryBlocks\Pages\CreateLaboratoryBlock;
use App\Filament\Resources\LaboratoryBlocks\Pages\EditLaboratoryBlock;
use App\Filament\Resources\LaboratoryBlocks\Pages\ListLaboratoryBlocks;
use App\Filament\Resources\LaboratoryBlocks\Schemas\LaboratoryBlockForm;
use App\Filament\Resources\LaboratoryBlocks\Tables\LaboratoryBlocksTable;
use App\Models\LaboratoryBlock;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LaboratoryBlockResource extends Resource
{
    protected static ?string $model = LaboratoryBlock::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return LaboratoryBlockForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaboratoryBlocksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLaboratoryBlocks::route('/'),
            'create' => CreateLaboratoryBlock::route('/create'),
            'edit' => EditLaboratoryBlock::route('/{record}/edit'),
        ];
    }
}
