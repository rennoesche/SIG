<?php

namespace App\Filament\Resources\ProvinsiResResource\Pages;

use App\Filament\Resources\ProvinsiResResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProvinsiRes extends ListRecords
{
    protected static string $resource = ProvinsiResResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
