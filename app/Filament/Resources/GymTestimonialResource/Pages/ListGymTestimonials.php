<?php

namespace App\Filament\Resources\GymTestimonialResource\Pages;

use App\Filament\Resources\GymTestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGymTestimonials extends ListRecords
{
    protected static string $resource = GymTestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
