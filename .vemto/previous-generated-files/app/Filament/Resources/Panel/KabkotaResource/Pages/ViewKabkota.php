<?php

namespace App\Filament\Resources\Panel\KabkotaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Panel\KabkotaResource;

class ViewKabkota extends ViewRecord
{
    protected static string $resource = KabkotaResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\EditAction::make()];
    }
}
