<?php

namespace App\Filament\Resources\Orion\NavigationResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\LatestResourcesTrait;
use App\Filament\Resources\Orion\NavigationResource;

class ListNavigations extends ListRecords
{
    use LatestResourcesTrait;

    protected static string $resource = NavigationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
