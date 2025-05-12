<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetTransactionResource\Pages;
use App\Filament\Resources\AssetTransactionResource\RelationManagers;
use App\Models\AssetTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use App\Helpers\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class AssetTransactionResource extends Resource
{
    protected static ?string $model = AssetTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-s-arrows-right-left';

    protected static ?string $navigationGroup = 'Transactions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('asset_id')
                    ->relationship('asset', 'name')
                    ->required(),
                Select::make('type')
                    ->options(['in' => 'Stok In', 'out' => 'Stok Out'])
                    ->required()
                    ->reactive(),
                TextInput::make('quantity')
                    ->numeric()
                    ->minValue(1)
                    ->required()
                    ->rule(function (callable $get) {
                        if ($get('type') === 'out') {
                            return function ($attribute, $value, $fail) use ($get) {
                                $asset = \App\Models\Asset::find($get('asset_id'));
                                if ($asset && $value > $asset->stock) {
                                    $fail('Stok tidak mencukupi untuk transaksi ini.');
                                }
                            };
                        }
                    }),

                Textarea::make('reason')
                    ->label('Alasan')
                    ->nullable(),
                Select::make('location_id')
                    ->relationship('location', 'name')
                    ->searchable(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable(),
                ]);
            }
    // Logging
    public static function mutateFormDataBeforeCreate(array $data): array
    {
        Log::info('MUTATE CALLED', $data); // Tambahkan log ini
        $data['user_id'] = Auth::id();
        $asset = \App\Models\Asset::find($data['asset_id']);
        $typeText = $data['type'] === 'in' ? 'Stok In' : 'Stok Out';
        Activity::log(
            'create',
            $typeText,
            "{$typeText} untuk aset {$asset->name} sebanyak {$data['quantity']} unit."
        );
        return $data;
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
            'index' => Pages\CreateAssetTransaction::route('/'),
            // 'create' => Pages\CreateAssetTransaction::route('/create'),
            // 'edit' => Pages\EditAssetTransaction::route('/{record}/edit'),
        ];
    }
}
