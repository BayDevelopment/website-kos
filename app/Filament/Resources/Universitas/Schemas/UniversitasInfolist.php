<?php

namespace App\Filament\Resources\Universitas\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class UniversitasInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Universitas')
                    ->description('Detail utama data universitas.')
                    ->icon('heroicon-o-building-library')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                ImageEntry::make('logo')
                                    ->label('Logo Universitas')
                                    ->circular()
                                    ->height(90)
                                    ->getStateUsing(
                                        fn($record) => $record->logo
                                            ? asset('storage/' . $record->logo)
                                            : asset('image/avatar/profile.png')
                                    ),

                                TextEntry::make('nama_universitas')
                                    ->label('Nama Universitas')
                                    ->weight('bold')
                                    ->size('lg'),

                                TextEntry::make('slug')
                                    ->label('Slug')
                                    ->badge()
                                    ->color('gray'),

                                TextEntry::make('jenis')
                                    ->label('Jenis Universitas')
                                    ->badge()
                                    ->color(fn($state) => match ($state) {
                                        'negeri' => 'success',
                                        'swasta' => 'info',
                                        default => 'gray',
                                    }),

                                TextEntry::make('kota')
                                    ->label('Kota')
                                    ->badge()
                                    ->color('warning'),
                            ]),
                    ])
                    ->columnSpanFull(),

                Section::make('Alamat & Website')
                    ->description('Informasi lokasi dan tautan resmi universitas.')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('alamat')
                                    ->label('Alamat')
                                    ->placeholder('Alamat belum tersedia')
                                    ->columnSpanFull(),

                                TextEntry::make('website')
                                    ->label('Website')
                                    ->state(
                                        fn($record) => filled(trim((string) $record->website))
                                            ? $record->website
                                            : 'Link Tidak Ada'
                                    )
                                    ->badge(fn($record) => blank(trim((string) $record->website)))
                                    ->color(fn($record) => blank(trim((string) $record->website)) ? 'gray' : 'warning')
                                    ->url(fn($record) => filled(trim((string) $record->website)) ? $record->website : null)
                                    ->openUrlInNewTab(),
                            ]),
                    ])
                    ->columnSpanFull(),

                Section::make('Status Sistem')
                    ->description('Status aktivasi dan informasi waktu data.')
                    ->icon('heroicon-o-shield-check')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                IconEntry::make('is_active')
                                    ->label('Status Aktif')
                                    ->boolean(),

                                TextEntry::make('created_at')
                                    ->label('Dibuat Pada')
                                    ->dateTime('d M Y, H:i'),

                                TextEntry::make('updated_at')
                                    ->label('Diperbarui Pada')
                                    ->dateTime('d M Y, H:i'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
