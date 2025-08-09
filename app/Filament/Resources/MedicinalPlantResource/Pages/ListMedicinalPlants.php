<?php

namespace App\Filament\Resources\MedicinalPlantResource\Pages;

use App\Filament\Resources\MedicinalPlantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicinalPlants extends ListRecords
{
    protected static string $resource = MedicinalPlantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
