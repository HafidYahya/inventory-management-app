<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetInTransactionResource\Pages;
use App\Filament\Resources\AssetInTransactionResource\RelationManagers;
use App\Models\AssetTransaction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\AssetRegistered;
use App\Models\Room;
use App\Models\Location;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class AssetInTransactionResource extends Resource
{
    protected static ?string $model = AssetTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-s-arrows-pointing-in';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $navigationLabel = 'Stok Masuk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('registered_asset_id')
                    ->label('Pilih Aset Terdaftar')
                    ->options(AssetRegistered::with('masterDataAsset')
                    ->where('is_registered', false)
                    ->get()
                    ->mapWithKeys(function ($item) {
                        $name = optional($item->masterDataAsset)->name ?? 'Tidak diketahui';
                        return [$item->id => "{$name} | EPC: {$item->epc}"];
                    })
                    )
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $asset = AssetRegistered::find($state);
                        if ($asset) {
                            $set('quantity', $asset->default_quantity);
                        }
                    }),
                TextInput::make('quantity')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                Select::make('location_id')
                    ->options(Location::all()->pluck('name', 'id'))
                    ->required()
                    ->reactive(),
                Select::make('room_id')
                    ->label('Ruangan')
                    ->options(fn ($get) => Room::where('location_id', $get('location_id'))->pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->disabled(fn ($get) => !$get('location_id')),
                Textarea::make('reason')->label('Keterangan (Opsional)'),
                Hidden::make('type')->default('in'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListAssetInTransactions::route('/'),
            'create' => Pages\CreateAssetInTransaction::route('/create'),
            'edit' => Pages\EditAssetInTransaction::route('/{record}/edit'),
        ];
    }
}
