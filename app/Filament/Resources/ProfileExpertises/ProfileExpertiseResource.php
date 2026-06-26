<?php

namespace App\Filament\Resources\ProfileExpertises;

use App\Filament\Resources\ProfileExpertises\Pages\CreateProfileExpertise;
use App\Filament\Resources\ProfileExpertises\Pages\EditProfileExpertise;
use App\Filament\Resources\ProfileExpertises\Pages\ListProfileExpertises;
use App\Filament\Resources\ProfileExpertises\Schemas\ProfileExpertiseForm;
use App\Filament\Resources\ProfileExpertises\Tables\ProfileExpertisesTable;
use App\Models\ProfileExpertise;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProfileExpertiseResource extends Resource
{
    protected static ?string $model = ProfileExpertise::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ProfileExpertiseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfileExpertisesTable::configure($table);
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
            'index' => ListProfileExpertises::route('/'),
            'create' => CreateProfileExpertise::route('/create'),
            'edit' => EditProfileExpertise::route('/{record}/edit'),
        ];
    }
}
