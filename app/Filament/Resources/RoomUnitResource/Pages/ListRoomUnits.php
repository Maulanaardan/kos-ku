<?php

namespace App\Filament\Resources\RoomUnitResource\Pages;

use App\Filament\Resources\RoomUnitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoomUnits extends ListRecords
{
    protected static string $resource = RoomUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
