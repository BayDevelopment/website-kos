<?php

namespace App\Filament\Resources\IdentitasPemiliks\Pages;

use App\Filament\Resources\IdentitasPemiliks\IdentitasPemilikResource;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateIdentitasPemilik extends CreateRecord
{
    protected static string $resource = IdentitasPemilikResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Notifikasi setelah berhasil create
     */
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Identitas Pemilik berhasil ditambahkan.');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Kembali')
                ->icon('heroicon-m-arrow-left')
                ->url($this->getResource()::getUrl('index')),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Simpan')
                ->icon('heroicon-m-check'),

            $this->getCreateAnotherFormAction()
                ->label('Simpan & tambah lagi')
                ->icon('heroicon-m-plus-circle'),

            $this->getCancelFormAction()
                ->label('Batal')
                ->icon('heroicon-m-x-circle'),
        ];
    }
}
