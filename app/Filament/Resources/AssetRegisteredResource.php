<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetRegisteredResource\Pages;
use App\Filament\Resources\AssetRegisteredResource\RelationManagers;
use App\Models\Asset;
use App\Models\AssetRegistered;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;


class AssetRegisteredResource extends Resource
{
    protected static ?string $model = AssetRegistered::class;

    protected static ?string $navigationIcon = 'heroicon-s-rectangle-stack';

    protected static ?string $navigationGroup = 'Assets';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('master_data_asset_id')
                    ->label('Asset')
                    ->options(Asset::all()->pluck('name','id'))
                    ->searchable()
                    ->required(),
                
                TextInput::make('epc')
                    ->label('EPC')
                    ->readOnly()
                    ->unique(),

                TextInput::make('default_quantity')
                    ->label('Quantity')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                Textarea::make('note'),
                Toggle::make('is_registered')
                    ->label('Already Stok In')
                    ->default(false)
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('masterDataAsset.name')->label('Nama Aset'),
                TextColumn::make('epc'),
                TextColumn::make('default_quantity')->label('Qty'),
                IconColumn::make('is_registered')->label('Stok In?')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListAssetRegistereds::route('/'),
            'create' => Pages\CreateAssetRegistered::route('/create'),
            'edit' => Pages\EditAssetRegistered::route('/{record}/edit'),
        ];
    }
}
