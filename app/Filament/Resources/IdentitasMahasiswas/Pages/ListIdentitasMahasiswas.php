<?php

namespace App\Filament\Resources\IdentitasMahasiswas\Pages;

use App\Filament\Resources\IdentitasMahasiswas\IdentitasMahasiswaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIdentitasMahasiswas extends ListRecords
{
    protected static string $resource = IdentitasMahasiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Identitas Mahasiswa')
                ->icon('heroicon-o-plus'),
        ];
    }
}
