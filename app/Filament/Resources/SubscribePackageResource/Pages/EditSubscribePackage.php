<?php

namespace App\Filament\Resources\SubscribePackageResource\Pages;

use App\Filament\Resources\SubscribePackageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubscribePackage extends EditRecord
{
    protected static string $resource = SubscribePackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
