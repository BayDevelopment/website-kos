<?php

namespace App\Filament\Resources\Universitas\Pages;

use App\Filament\Resources\Universitas\UniversitasResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUniversitas extends ViewRecord
{
    protected static string $resource = UniversitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Kembali')
                ->icon('heroicon-m-arrow-left')
                ->url($this->getResource()::getUrl('index')),
        ];
    }
}
