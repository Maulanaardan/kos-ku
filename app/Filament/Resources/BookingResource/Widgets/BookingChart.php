<?php

namespace App\Filament\Resources\BookingResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Bookings;

class BookingChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $data = Bookings::selectRaw('MONTH(start_date) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        return [
            'datasets' => [
                [
                    'label' => 'Booking per Bulan',
                    'data' => $data->values(),
                ],
            ],
            'labels' => $data->keys()->map(function ($month) {
                return date("F", mktime(0, 0, 0, (int) $month, 1));
            }),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
