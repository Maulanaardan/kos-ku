<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacilityResource\Pages;
use App\Models\Facilities;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class FacilityResource extends Resource
{
    protected static ?string $model = Facilities::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Fasilitas')
                    ->required(),

                TextInput::make('quantity')
                    ->label('Jumlah Fasilitas')
                    ->numeric()
                    ->required(),

                TextInput::make('description')
                    ->label('Deskripsi')
                    ->placeholder('tulis deskripsi')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Fasilitas'),
                TextColumn::make('description')->label('Deskripsi'),
                TextColumn::make('quantity')->label('Jumlah Fasilitas'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFacilities::route('/'),
            'create' => Pages\CreateFacility::route('/create'),
            'edit' => Pages\EditFacility::route('/{record}/edit'),
        ];
    }
}
