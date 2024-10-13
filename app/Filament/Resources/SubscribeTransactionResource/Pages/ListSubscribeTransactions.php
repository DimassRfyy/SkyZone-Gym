<?php

namespace App\Filament\Resources\SubscribeTransactionResource\Pages;

use App\Filament\Resources\SubscribeTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubscribeTransactions extends ListRecords
{
    protected static string $resource = SubscribeTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
