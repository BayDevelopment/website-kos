<?php

namespace App\Filament\Resources\IdentitasMahasiswas\Pages;

use App\Filament\Resources\IdentitasMahasiswas\IdentitasMahasiswaResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditIdentitasMahasiswa extends EditRecord
{
    protected static string $resource = IdentitasMahasiswaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Notifikasi setelah berhasil create
     */
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Identitas Mahasiswa berhasil diperbarui.');
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
            $this->getSaveFormAction()
                ->label('Simpan')
                ->icon('heroicon-m-check'),

            $this->getCancelFormAction()
                ->label('Batal')
                ->icon('heroicon-m-x-circle'),
        ];
    }
}
