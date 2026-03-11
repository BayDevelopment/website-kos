<?php

namespace App\Filament\Resources\IdentitasMahasiswas\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class IdentitasMahasiswasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Foto')
                    ->circular()
                    ->getStateUsing(
                        fn($record) => $record->avatar
                            ? asset('storage/' . $record->avatar)
                            : asset('image/avatar/profile.png')
                    ),

                TextColumn::make('user.name')
                    ->label('Nama Akun')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('universitas.nama_universitas')
                    ->label('Universitas')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('semester')
                    ->badge()
                    ->sortable(),

                TextColumn::make('verification_status')
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
