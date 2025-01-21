<?php

namespace App\Filament\Resources\Panel\KabkotaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Panel\KabkotaResource;

class EditKabkota extends EditRecord
{
    protected static string $resource = KabkotaResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
