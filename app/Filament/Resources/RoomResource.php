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

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationGroup = 'Room';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')->label('Nama Kamar'),
            TextInput::make('description')->label('Deskripsi'),
            TextInput::make('capacity')->numeric(),
            TextInput::make('price')->label('Harga'),
            FileUpload::make('image')
                ->image()
                ->disk('public')
                ->required()
                ->preserveFilenames() // opsional: biar nama file gak diacak
                ->imageEditor(),      // opsional editor                  
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
            ->disk('public')
            ->visibility('public') // opsional
            ->circular()
            ->height(50)
            ->width(50),

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
