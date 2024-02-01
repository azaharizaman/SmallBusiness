<?php

namespace App\Filament\Resources\ProductPricingResource\Pages;

use App\Filament\Resources\ProductPricingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductPricings extends ListRecords
{
    protected static string $resource = ProductPricingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
