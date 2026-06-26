<?php

namespace App\Filament\Resources\ProfileSettings;

use App\Filament\Resources\ProfileSettings\Pages\CreateProfileSetting;
use App\Filament\Resources\ProfileSettings\Pages\EditProfileSetting;
use App\Filament\Resources\ProfileSettings\Pages\ListProfileSettings;
use App\Filament\Resources\ProfileSettings\Schemas\ProfileSettingForm;
use App\Filament\Resources\ProfileSettings\Tables\ProfileSettingsTable;
use App\Models\ProfileSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProfileSettingResource extends Resource
{
    protected static ?string $model = ProfileSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'full_name';

    protected static ?string $navigationLabel = 'Profile Settings';

    protected static ?string $modelLabel = 'Profile Setting';

    protected static ?string $pluralModelLabel = 'Profile Settings';

    public static function form(Schema $schema): Schema
    {
        return ProfileSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfileSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProfileSettings::route('/'),
            'create' => CreateProfileSetting::route('/create'),
            'edit' => EditProfileSetting::route('/{record}/edit'),
        ];
    }
}
