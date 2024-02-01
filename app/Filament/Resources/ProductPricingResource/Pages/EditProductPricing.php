<?php

namespace App\Filament\Resources\ProductPricingResource\Pages;

use App\Filament\Resources\ProductPricingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductPricing extends EditRecord
{
    protected static string $resource = ProductPricingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
