<?php

namespace App\Filament\Resources\IdentitasMahasiswas;

use App\Filament\Resources\IdentitasMahasiswas\Pages\CreateIdentitasMahasiswa;
use App\Filament\Resources\IdentitasMahasiswas\Pages\EditIdentitasMahasiswa;
use App\Filament\Resources\IdentitasMahasiswas\Pages\ListIdentitasMahasiswas;
use App\Filament\Resources\IdentitasMahasiswas\Schemas\IdentitasMahasiswaForm;
use App\Filament\Resources\IdentitasMahasiswas\Tables\IdentitasMahasiswasTable;
use App\Models\IdentitasMahasiswa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class IdentitasMahasiswaResource extends Resource
{
    protected static ?string $model = IdentitasMahasiswa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static ?string $recordTitleAttribute = 'nama_lengkap';

    // APP
    public static function getNavigationGroup(): ?string
    {
        return 'Manajemen';
    }

    protected static ?string $navigationLabel = 'Identitas Mahasiswa';

    protected static ?string $modelLabel = 'Identitas Mahasiswa';

    protected static ?string $pluralModelLabel = 'Daftar Identitas';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return IdentitasMahasiswaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IdentitasMahasiswasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIdentitasMahasiswas::route('/'),
            'create' => CreateIdentitasMahasiswa::route('/create'),
            'edit' => EditIdentitasMahasiswa::route('/{record}/edit'),
        ];
    }
}
