<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use App\Models\Room;
use App\Models\RoomUnit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;


class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'Setting';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Customer')
                    ->required(),

                Select::make('rooms.name')
                    ->label('Jenis Kamar')
                    ->relationship('rooms', 'name'),

                    Select::make('room_units.unit_number')
                    ->label('Nomor Kamar')
                    ->relationship('room_units', 'unit_number'),

                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->numeric()
                    ->required(),

                TextArea::make('address')
                    ->label('Alamat')
                    ->required()
                    ->autosize(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Customer')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('room.name')
                    ->label('Jenis Kamar')
                    ->sortable(),

                TextColumn::make('room_units.unit_number')
                    ->label('Nomor Kamar')
                    ->sortable(),

                TextColumn::make('phone')
                    ->label('Nomor Telepon'),

                TextColumn::make('address')
                    ->label('Alamat'),

                TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
