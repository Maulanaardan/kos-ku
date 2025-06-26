<?php

namespace App\Filament\Resources\RoomResource\Widgets;

use App\Models\Room;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class KamarStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Kamar', Room::count()),
            Card::make('Kamar Kosong', Room::where('is_available', 1)->count()),
            Card::make('Kamar Terisi', Room::where('is_available', 0)->count()),
        ];
    }
}
