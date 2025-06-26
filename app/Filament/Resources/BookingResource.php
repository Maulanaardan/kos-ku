<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Bookings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\Action;
use App\Filament\Resources\RoomResource\Widgets\BookingChart;

class BookingResource extends Resource
{
    protected static ?string $model = Bookings::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                TextColumn::make('user.name')->label('Nama Pemesan'),
                TextColumn::make('room.name')->label('Kamar'),
                TextColumn::make('start_date')->label('Mulai'),
                TextColumn::make('end_date')->label('Selesai'),
                BadgeColumn::make('status')->colors([
                    'warning' => 'pending',
                    'success' => 'confirmed',
                    'danger' => 'cancelled',
                ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Konfirmasi')
                ->visible(fn ($record) => $record->status === 'pending')
                ->action(function ($record) {
                    $record->update(['status' => 'confirmed']);
                })
                ->color('success')
                ->icon('heroicon-o-check'),

            Action::make('Batalkan')
                ->visible(fn ($record) => $record->status === 'pending')
                ->action(function ($record) {
                    $record->update(['status' => 'cancelled']);
                })
                ->color('danger')
                ->icon('heroicon-o-x-mark'),

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
            BookingChart::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
