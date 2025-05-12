<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserManagementResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use App\Helpers\Activity;

class UserManagementResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';
    protected static ?string $navigationLabel = 'Users Management';
    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required(),

            TextInput::make('email')
                ->email()
                ->required()
                ->unique('users', 'email', ignoreRecord: true),

            TextInput::make('password')
                ->password()
                ->label('Password')
                ->required(fn (string $context) => $context === 'create')
                ->dehydrated(fn ($state) => filled($state)) // hanya simpan jika ada isi
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->minLength(8)
                ->confirmed(),

            TextInput::make('password_confirmation')
                ->password()
                ->label('Confirm Password')
                ->required(fn (string $context) => $context === 'create')
                ->dehydrated(false), // tidak dikirim ke DB

            Select::make('role')
                ->required()
                ->options([
                    'admin' => 'Admin',
                    'it' => 'IT Division',
                    'owner' => 'Owner',
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Name Copied'),
                TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email Copied'),
                TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->label('Date Created')
                    ->searchable(),
                TextColumn::make('role')
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'admin' => 'Admin',
                        'it' => 'IT Division',
                        'owner' => 'Owner',
                        default => ucfirst($state),
                    }),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->before(function ($record) {
                    Activity::log(
                        'delete',
                        'Users Management',
                        "Delete user with name \"{$record->name}\" and email {$record->email}."
                    );
                }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserManagement::route('/'),
            'create' => Pages\CreateUserManagement::route('/create'),
            'edit' => Pages\EditUserManagement::route('/{record}/edit'),
        ];
    }
}
