<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StokOutReasonResource\Pages;
use App\Filament\Resources\StokOutReasonResource\RelationManagers;
use App\Models\StockOutReason;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;

class StokOutReasonResource extends Resource
{
    protected static ?string $model = StockOutReason::class;

    protected static ?string $navigationIcon = 'heroicon-s-clipboard-document-list';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Kategori Stok Out')
                ->required()
                ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Kategori Stok Out')
                    ->searchable(),
                TextColumn ::make('created_at')
                    ->label('Tanggal Input')
                    ->dateTime()
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
            'index' => Pages\ListStokOutReasons::route('/'),
            'create' => Pages\CreateStokOutReason::route('/create'),
            'edit' => Pages\EditStokOutReason::route('/{record}/edit'),
        ];
    }
}
