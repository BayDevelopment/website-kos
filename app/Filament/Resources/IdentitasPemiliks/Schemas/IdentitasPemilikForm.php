<?php

namespace App\Filament\Resources\IdentitasPemiliks\Schemas;

use App\Models\User;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Validation\Rule;

class IdentitasPemilikForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Pemilik')
                    ->description('Lengkapi data identitas pemilik kos sesuai data pada sistem.')
                    ->icon('heroicon-o-identification')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('user_id')
                                    ->label('Pilih Akun')
                                    ->options(
                                        User::query()
                                            ->where('role', 'pemilik_kos')
                                            ->whereDoesntHave('identitasPemilik')
                                            ->pluck('name', 'id')
                                    )
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->visible(fn(string $operation) => $operation === 'create')
                                    ->rules([
                                        Rule::unique('identitas_pemilik', 'user_id'),
                                    ])
                                    ->validationMessages([
                                        'required' => 'Akun pemilik wajib dipilih.',
                                        'unique' => 'Akun salah atau sudah terdaftar sebagai identitas pemilik.',
                                    ])
                                    ->helperText('Pilih akun pemilik yang belum memiliki identitas.'),

                                Placeholder::make('user.name')
                                    ->label('Nama Akun')
                                    ->content(fn($record) => $record?->user?->name ?? '-')
                                    ->visible(fn(string $operation) => $operation === 'edit'),

                                TextInput::make('nama_lengkap')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('nik')
                                    ->label('NIK')
                                    ->required()
                                    ->maxLength(20)
                                    ->unique(ignoreRecord: true),

                                Select::make('jenis_kelamin')
                                    ->label('Jenis Kelamin')
                                    ->options([
                                        'laki-laki' => 'Laki-laki',
                                        'perempuan' => 'Perempuan',
                                    ])
                                    ->required(),

                                TextInput::make('no_wa')
                                    ->label('Nomor WhatsApp')
                                    ->tel()
                                    ->required()
                                    ->maxLength(20),

                                TextInput::make('nama_usaha')
                                    ->label('Nama Usaha / Nama Kos')
                                    ->required()
                                    ->maxLength(255),

                                Select::make('status_pengelola')
                                    ->label('Status Pengelola')
                                    ->options([
                                        'pemilik' => 'Pemilik',
                                        'pengelola' => 'Pengelola',
                                        'agen' => 'Agen',
                                    ])
                                    ->default('pemilik')
                                    ->required(),

                                FileUpload::make('avatar')
                                    ->label('Avatar')
                                    ->image()
                                    ->imageEditor()
                                    ->acceptedFileTypes(['image/jpeg', 'image/jpg'])
                                    ->maxSize(1024)
                                    ->directory('pemilik/avatar')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->nullable()
                                    ->columnSpanFull()
                                    ->helperText('Format JPG, maksimal 1MB'),

                                FileUpload::make('foto_ktp')
                                    ->label('Foto KTP')
                                    ->image()
                                    ->imageEditor()
                                    ->acceptedFileTypes(['image/jpeg', 'image/jpg'])
                                    ->maxSize(1024)
                                    ->directory('pemilik/ktp')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->required()
                                    ->helperText('Format JPG, maksimal 1MB'),

                                FileUpload::make('foto_selfie')
                                    ->label('Foto Selfie dengan KTP')
                                    ->image()
                                    ->imageEditor()
                                    ->acceptedFileTypes(['image/jpeg', 'image/jpg'])
                                    ->maxSize(1024)
                                    ->directory('pemilik/selfie')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->required()
                                    ->helperText('Format JPG, maksimal 1MB'),

                                Textarea::make('alamat')
                                    ->label('Alamat')
                                    ->rows(4)
                                    ->required()
                                    ->columnSpanFull(),

                                Select::make('verification_status')
                                    ->label('Status Verifikasi')
                                    ->options([
                                        'pending' => 'Pending',
                                        'approved' => 'Approved',
                                        'rejected' => 'Rejected',
                                    ])
                                    ->default('pending')
                                    ->live()
                                    ->required(),

                                Textarea::make('verification_note')
                                    ->label('Catatan Verifikasi')
                                    ->rows(3)
                                    ->visible(fn(Get $get) => $get('verification_status') === 'rejected')
                                    ->required(fn(Get $get) => $get('verification_status') === 'rejected')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
