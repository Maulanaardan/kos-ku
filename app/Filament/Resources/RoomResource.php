<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Models\Room;
use App\Models\Facilities;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput; 
use Filament\Forms\Components\Select;   
use Filament\Forms\Components\FileUpload; 
use Filament\Forms\Components\CheckboxList;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Support\Enums\IconPosition;
use App\Filament\Resources\RoomResource\Widgets\KamarStats;


class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')->label('Nama Kamar'),
            TextInput::make('description')->label('Deskripsi'),
            TextInput::make('capacity')->numeric(),
            TextInput::make('price')->label('Harga'),
            Select::make('is_available')
                ->options([
                    1 => 'KOSONG',   // tersedia
                    0 => 'ISI',
                ])
                ->required(),
            FileUpload::make('image')->label('Gambar'),
            CheckboxList::make('facilities')
            ->label('Fasilitas')
            ->relationship('facilities', 'name')
            ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            ImageColumn::make('image')
                ->label('Gambar')
                ->circular(), // opsional: bikin gambar bulat

            TextColumn::make('name')
                ->label('Nama Kamar')
                ->searchable()
                ->sortable(),

            TextColumn::make('description')
                ->label('Deskripsi')
                ->limit(30),

            TextColumn::make('capacity')
                ->label('Kapasitas'),

            TextColumn::make('price')
                ->label('Harga')
                ->money('IDR', true),

            IconColumn::make('is_available')
                ->label('Status')
                ->boolean()
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->trueColor('success')
                ->falseColor('danger'),
        ])
        ->filters([])
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
    
    
    public static function getHeaderWidgets(): array
    {
        return [
            KamarStats::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
