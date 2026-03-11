<?php

namespace App\Filament\Resources\IdentitasPemiliks\Pages;

use App\Filament\Resources\IdentitasPemiliks\IdentitasPemilikResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIdentitasPemiliks extends ListRecords
{
    protected static string $resource = IdentitasPemilikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Identitas Pemilik')
                ->icon('heroicon-o-plus'),
        ];
    }
}
