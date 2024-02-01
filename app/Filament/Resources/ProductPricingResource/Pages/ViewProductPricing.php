<?php

namespace App\Filament\Resources\ProductPricingResource\Pages;

use App\Filament\Resources\ProductPricingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProductPricing extends ViewRecord
{
    protected static string $resource = ProductPricingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
