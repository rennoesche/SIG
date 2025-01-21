<?php

namespace App\Filament\Resources\Panel\KabkotaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Panel\KabkotaResource;

class ListKabkotas extends ListRecords
{
    protected static string $resource = KabkotaResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
