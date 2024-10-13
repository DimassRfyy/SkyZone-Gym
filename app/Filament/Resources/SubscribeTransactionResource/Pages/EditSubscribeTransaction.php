<?php

namespace App\Filament\Resources\SubscribeTransactionResource\Pages;

use App\Filament\Resources\SubscribeTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubscribeTransaction extends EditRecord
{
    protected static string $resource = SubscribeTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
