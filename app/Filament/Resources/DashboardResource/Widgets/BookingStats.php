<?php

namespace App\Filament\Widgets;

use App\Models\Bookings;
use App\Models\RoomUnit;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BookingStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Booking', Bookings::count())
                ->description('Semua status booking'),
            
            Stat::make('Unit Tersedia', RoomUnit::whereDoesntHave('bookings', function ($query) {
                $query->whereIn('status', ['pending', 'confirmed']);
            })->count())
                ->description('Unit yang belum dibooking'),
            
            Stat::make('Total Customer', User::where('role', 'customer')->count())
                ->description('Pengguna dengan role customer'),
        ];
    }
}
