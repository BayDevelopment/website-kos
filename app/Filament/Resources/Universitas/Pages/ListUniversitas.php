<?php

namespace App\Filament\Resources\Universitas\Pages;

use App\Filament\Resources\Universitas\UniversitasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUniversitas extends ListRecords
{
    protected static string $resource = UniversitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Universitas')
                ->icon('heroicon-o-plus'),
        ];
    }
}
