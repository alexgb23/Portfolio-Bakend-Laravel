<?php

namespace App\Filament\Resources\ProfileSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProfileSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('full_name')
                    ->required(),
                TextInput::make('display_name'),
                TextInput::make('headline')
                    ->required(),
                TextInput::make('subheadline'),
                Textarea::make('bio_short')
                    ->columnSpanFull(),
                Textarea::make('bio_long')
                    ->columnSpanFull(),
                TextInput::make('location'),
                TextInput::make('email_public')
                    ->email(),
                TextInput::make('website_url')
                    ->url(),
                TextInput::make('resume_url')
                    ->url(),
                TextInput::make('status_label'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
