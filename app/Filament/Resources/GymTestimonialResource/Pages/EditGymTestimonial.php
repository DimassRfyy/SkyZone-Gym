<?php

namespace App\Filament\Resources\GymTestimonialResource\Pages;

use App\Filament\Resources\GymTestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGymTestimonial extends EditRecord
{
    protected static string $resource = GymTestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
