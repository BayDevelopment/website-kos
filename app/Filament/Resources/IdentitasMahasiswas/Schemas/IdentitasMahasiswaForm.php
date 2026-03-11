<?php

namespace App\Filament\Resources\IdentitasMahasiswas\Schemas;

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

class IdentitasMahasiswaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Mahasiswa')
                    ->description('Lengkapi data identitas mahasiswa sesuai data pada sistem.')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('user_id')
                                    ->label('Pilih Akun')
                                    ->options(
                                        User::query()
                                            ->where('role', 'mahasiswa')
                                            ->whereDoesntHave('identitasMahasiswa') // yang belum punya identitas
                                            ->pluck('name', 'id')
                                    )
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->visible(fn(string $operation) => $operation === 'create')
                                    ->rules([
                                        Rule::unique('identitas_mahasiswas', 'user_id'),
                                    ])
                                    ->validationMessages([
                                        'required' => 'Akun mahasiswa wajib dipilih.',
                                        'unique' => 'Akun salah atau sudah terdaftar sebagai identitas mahasiswa.',
                                    ])
                                    ->helperText('Pilih akun mahasiswa yang belum memiliki identitas.'),

                                Select::make('universitas_id')
                                    ->label('Universitas')
                                    ->relationship('universitas', 'nama_universitas')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                TextInput::make('nama_lengkap')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('semester')
                                    ->label('Semester')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(14)
                                    ->required(),

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

                                Select::make('asal_kota')
                                    ->label('Asal Kota')
                                    ->options([
                                        'Kota Cilegon' => 'Kota Cilegon',
                                        'Kota Serang' => 'Kota Serang',
                                    ])
                                    ->required(),

                                TextInput::make('no_wa')
                                    ->label('Nomor WhatsApp')
                                    ->tel()
                                    ->required()
                                    ->maxLength(20),

                                FileUpload::make('avatar')
                                    ->label('Avatar')
                                    ->image()
                                    ->imageEditor()
                                    ->acceptedFileTypes(['image/jpeg', 'image/jpg'])
                                    ->maxSize(1024) // 1 MB
                                    ->directory('mahasiswa/avatar')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->nullable()
                                    ->columnSpanFull()
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
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
