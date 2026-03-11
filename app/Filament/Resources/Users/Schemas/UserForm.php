<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Informasi User')
                    ->icon('heroicon-o-user')
                    ->columns(2)
                    ->schema([

                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Select::make('role')
                            ->label('Role')
                            ->required()
                            ->options([
                                'mahasiswa' => 'Mahasiswa',
                                'pemilik_kos' => 'Pemilik Kos',
                                'admin' => 'Admin',
                            ])
                            ->default('mahasiswa'),

                    ])
                    ->columnSpanFull(),


                Section::make('Keamanan Akun')
                    ->icon('heroicon-o-lock-closed')
                    ->columns(2)
                    ->schema([

                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable()
                            ->autocomplete('new-password')
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->minLength(8)
                            ->maxLength(255)
                            ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn($state) => filled($state))
                            ->helperText('Minimal 8 karakter. Kosongkan jika tidak ingin mengubah password saat edit.')

                    ])
                    ->columnSpanFull(),


                Section::make('Status Verifikasi')
                    ->icon('heroicon-o-shield-check')
                    ->columns(2)
                    ->schema([

                        DateTimePicker::make('email_verified_at')
                            ->label('Email Verified At')
                            ->nullable(),

                        DateTimePicker::make('policy_accepted_at')
                            ->label('Policy Accepted At')
                            ->nullable(),

                    ])
                    ->columnSpanFull(),

            ]);
    }
}
