<?php

namespace App\Filament\Pages;

use App\Models\Asset;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;

class AssetsList extends Page implements HasTable
{
    
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-s-document-text';
    protected static bool $hasTable = true;

    protected static string $view = 'filament.pages.assets-list';

    protected static ?string $navigationGroup = 'Assets';

    public function table(Table $table): Table
    {
        return $table
            ->query(Asset::query())
            ->columns([
                TextColumn::make('product_code')->label('Kode'),
                TextColumn::make('name')->label('Nama'),
                TextColumn::make('category')->label('Kategori'),
                TextColumn::make('merk')->label('Merk'),
                TextColumn::make('unit')->label('Satuan'),
                TextColumn::make('stock')->label('Stok Sekarang'),
                TextColumn::make('status')->label('Status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Tersedia' => 'success',
                        'Hampir Habis' => 'warning',
                        'Habis' => 'danger',
                        'Disposal' => 'gray',
                    }),
                TextColumn::make('created_at')->label('Tanggal Input')->date(),
            ]);
    }
}
