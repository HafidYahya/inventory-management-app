<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages;
use App\Filament\Resources\ActivityLogResource\RelationManagers;
use App\Models\ActivityLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

class ActivityLogResource extends Resource
{
    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->orderBy('created_at', 'desc'); // urut dari terbaru
}
    public static function isReadOnly(): bool
    {
        return true;
    }

    protected static ?string $model = ActivityLog::class;

    protected static ?string $navigationIcon = 'heroicon-s-newspaper';
    protected static ?string $navigationGroup = 'Activity History';

    
    

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
                TextColumn::make('user.name')->label('User'),
                TextColumn::make('action')->label('Activity')->badge(),
                TextColumn::make('module')->label('Module'),
                TextColumn::make('description')->label('Description'),
                TextColumn::make('created_at')->label('Time')->since(),
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
            'index' => Pages\ListActivityLogs::route('/'),
            // 'create' => Pages\CreateActivityLog::route('/create'),
            // 'edit' => Pages\EditActivityLog::route('/{record}/edit'),
        ];
    }
}

