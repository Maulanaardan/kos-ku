<?php

namespace App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\Widgets\BookingChart;

use App\Filament\Resources\BookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    public function getHeaderWidgets(): array
    {
        return [
            BookingChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
