<?php

namespace App\Filament\Resources\ProductCollectionResource\Pages;

use App\Filament\Resources\ProductCollectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProductCollection extends ViewRecord
{
    protected static string $resource = ProductCollectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
