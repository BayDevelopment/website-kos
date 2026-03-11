<?php

namespace App\Filament\Resources\Universitas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UniversitasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->circular()
                    ->getStateUsing(
                        fn($record) => $record->logo
                            ? asset('storage/' . $record->logo)
                            : asset('image/avatar/profile.png')
                    ),

                TextColumn::make('nama_universitas')
                    ->label('Nama Universitas')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'negeri' => 'success',
                        'swasta' => 'info',
                        default => 'gray',
                    }),

                TextColumn::make('kota')
                    ->label('Kota')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('website')
                    ->label('Website')
                    ->getStateUsing(function ($record) {
                        $website = trim((string) $record->website);

                        return $website !== '' ? $website : 'Link Tidak Ada';
                    })
                    ->badge(fn($record) => trim((string) $record->website) === '')
                    ->color(fn($record) => trim((string) $record->website) === '' ? 'gray' : 'warning')
                    ->url(function ($record) {
                        $website = trim((string) $record->website);

                        return $website !== '' ? $website : null;
                    })
                    ->openUrlInNewTab()
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
