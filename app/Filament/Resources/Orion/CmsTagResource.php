<?php

namespace App\Filament\Resources\Orion;

use Filament\Tables;
use App\Models\CmsTag;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColorColumn;
use Filament\Forms\Components\ColorPicker;
use App\Filament\Resources\Orion\CmsTagResource\Pages;

class CmsTagResource extends Resource
{
    protected static ?string $model = CmsTag::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Administration';

    protected static ?string $slug = 'administration/cms-tags';

    protected static ?string $label = 'Tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Main')
                    ->tabs([
                        Tab::make('Home')
                            ->icon('heroicon-o-home')
                            ->schema([
                                TextInput::make('name')
                                    ->placeholder('Tag name')
                                    ->required()
                                    ->autocomplete('name')
                                    ->columnSpan('full'),

                                ColorPicker::make('background_color')
                                    ->required()
                                    ->placeholder('The background color of the tag')
                                    ->columnSpan('full'),
                            ]),
                    ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID'),

                TextColumn::make('name')
                    ->limit(50),

                ColorColumn::make('background_color')
                    ->copyable()
                    ->copyMessage('Color code copied')
                    ->copyMessageDuration(1500)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListCmsTags::route('/'),
            'create' => Pages\CreateCmsTag::route('/create'),
            'edit' => Pages\EditCmsTag::route('/{record}/edit'),
        ];
    }
}
