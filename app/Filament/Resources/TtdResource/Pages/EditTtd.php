<?php

namespace App\Filament\Resources\TtdResource\Pages;

use App\Filament\Resources\TtdResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTtd extends EditRecord
{
    protected static string $resource = TtdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
