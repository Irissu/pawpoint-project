<?php

namespace App\Filament\Resources\PetResource\Pages;

use App\Filament\Resources\PetResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePet extends CreateRecord
{
    protected static string $resource = PetResource::class;

/*     protected function mutateFormDataBeforeCreate(array $data): array {
        if (auth()->user()->isOwner()) {
            $data['owner_id'] = auth()->id();
        }
        return $data;
    } */

}
