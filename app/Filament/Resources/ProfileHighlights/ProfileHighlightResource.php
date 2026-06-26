<?php

namespace App\Filament\Resources\ProfileHighlights;

use App\Filament\Resources\ProfileHighlights\Pages\CreateProfileHighlight;
use App\Filament\Resources\ProfileHighlights\Pages\EditProfileHighlight;
use App\Filament\Resources\ProfileHighlights\Pages\ListProfileHighlights;
use App\Filament\Resources\ProfileHighlights\Schemas\ProfileHighlightForm;
use App\Filament\Resources\ProfileHighlights\Tables\ProfileHighlightsTable;
use App\Models\ProfileHighlight;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProfileHighlightResource extends Resource
{
    protected static ?string $model = ProfileHighlight::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ProfileHighlightForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfileHighlightsTable::configure($table);
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
            'index' => ListProfileHighlights::route('/'),
            'create' => CreateProfileHighlight::route('/create'),
            'edit' => EditProfileHighlight::route('/{record}/edit'),
        ];
    }
}
