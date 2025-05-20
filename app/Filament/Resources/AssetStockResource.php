<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetStockResource\Pages;
use App\Filament\Resources\AssetStockResource\RelationManagers;
use App\Models\AssetStock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssetStockResource extends Resource
{
    protected static ?string $model = AssetStock::class;

    protected static ?string $navigationIcon = 'heroicon-s-rectangle-stack';
    protected static ?string $navigationGroup = 'Assets';
    public static function isReadOnly(): bool
    {
        return true;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('asset.product_code')->label('Kode'),
                TextColumn::make('asset.name')->label('Nama Aset'),
                TextColumn::make('asset.category')->label('Kategori'),
                TextColumn::make('asset.merk')->label('Merk'),
                TextColumn::make('location.name')->label('Lokasi'),
                TextColumn::make('room.name')->label('Ruangan'),
                TextColumn::make('quantity')
                    ->label('QTY')
                    ->formatStateUsing(function ($state, $record) {
                        return $state . ' ' . ($record->asset->unit ?? '');
                    }),
                TextColumn::make('asset.status')->label('Status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Tersedia' => 'success',
                        'Hampir Habis' => 'warning',
                        'Habis' => 'danger',
                        'Disposal' => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListAssetStocks::route('/'),
            // 'create' => Pages\CreateAssetStock::route('/create'),
            // 'edit' => Pages\EditAssetStock::route('/{record}/edit'),
        ];
    }
}
