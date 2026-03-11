<?php

namespace App\Filament\Resources\IdentitasPemiliks\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class IdentitasPemiliksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Foto')
                    ->circular()
                    ->getStateUsing(function ($record) {
                        if ($record->avatar) {
                            return asset('storage/' . $record->avatar);
                        }

                        return match ($record->jenis_kelamin) {
                            'laki-laki' => asset('image/avatar/man.png'),
                            'perempuan' => asset('image/avatar/woman.png'),
                            default => asset('image/avatar/profile.png'),
                        };
                    }),

                TextColumn::make('user.name')
                    ->label('Nama Akun')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama_usaha')
                    ->label('Nama Usaha')
                    ->searchable(),

                TextColumn::make('status_pengelola')
                    ->label('Status')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'pemilik' => 'success',
                        'pengelola' => 'info',
                        'agen' => 'warning',
                    }),

                TextColumn::make('no_wa')
                    ->label('WhatsApp'),

                TextColumn::make('verification_status')
                    ->label('Verifikasi')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make()
                        ->label('Edit')
                        ->icon('heroicon-m-pencil'),

                    DeleteAction::make()
                        ->label('Hapus')
                        ->icon('heroicon-m-trash')
                        ->modalHeading('Hapus Data')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data ini?')
                        ->modalSubmitActionLabel('Ya, hapus')
                        ->successNotificationTitle('Data berhasil dihapus'),
                ])
                    ->label('Aksi')
                    ->icon('heroicon-m-cog-6-tooth'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
