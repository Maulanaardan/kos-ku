<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomUnitResource\Pages;
use App\Filament\Resources\RoomUnitResource\RelationManagers;
use App\Models\RoomUnit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput; 
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;

class RoomUnitResource extends Resource
{
    protected static ?string $model = RoomUnit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('room_id')
                    ->label('Nama Kamar')
                    ->relationship('room', 'name'),
                TextInput::make('unit_number')->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('room.name')
                ->label('Nama Kamar'),

                TextColumn::make('unit_number')
                ->label('Nomor Kamar'),
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
            'index' => Pages\ListRoomUnits::route('/'),
            'create' => Pages\CreateRoomUnit::route('/create'),
            'edit' => Pages\EditRoomUnit::route('/{record}/edit'),
        ];
    }
}
