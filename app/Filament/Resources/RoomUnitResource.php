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
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;

class RoomUnitResource extends Resource
{
    protected static ?string $model = RoomUnit::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationGroup = 'Room';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('room_id')
                    ->label('Nama Kamar')
                    ->relationship('room', 'name'),
                TextInput::make('unit_number')->numeric(),
                Select::make('available')
                ->options([
                    1 => 'KOSONG',   // tersedia
                    0 => 'ISI',
                ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultGroup('room.name')
            ->columns([
                TextColumn::make('room.name')
                ->label('Nama Kamar'),

                TextColumn::make('unit_number')
                ->label('Nomor Kamar'),

                IconColumn::make('is_available')
                ->label('Status')
                ->boolean()
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->trueColor('success')
                ->falseColor('danger'),
            ])
            ->filters([
                SelectFilter::Make('room.name')
                ->label('Jenis Kamar')
                ->options([
                    'expert' => 'Expert', 
                    'reguler' => 'Reguler'])
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
