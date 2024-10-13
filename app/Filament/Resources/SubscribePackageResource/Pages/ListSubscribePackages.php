<?php

namespace App\Filament\Resources\SubscribePackageResource\Pages;

use App\Filament\Resources\SubscribePackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubscribePackages extends ListRecords
{
    protected static string $resource = SubscribePackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
