<?php

namespace App\Filament\Resources\IdentitasPemiliks;

use App\Filament\Resources\IdentitasPemiliks\Pages\CreateIdentitasPemilik;
use App\Filament\Resources\IdentitasPemiliks\Pages\EditIdentitasPemilik;
use App\Filament\Resources\IdentitasPemiliks\Pages\ListIdentitasPemiliks;
use App\Filament\Resources\IdentitasPemiliks\Schemas\IdentitasPemilikForm;
use App\Filament\Resources\IdentitasPemiliks\Tables\IdentitasPemiliksTable;
use App\Models\IdentitasPemilik;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class IdentitasPemilikResource extends Resource
{
    protected static ?string $model = IdentitasPemilik::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static ?string $recordTitleAttribute = 'nama_lengkap';

    // NEW
    public static function getNavigationGroup(): ?string
    {
        return 'Manajemen';
    }

    protected static ?string $navigationLabel = 'Identitas Pemilik';

    protected static ?string $modelLabel = 'Identitas Pemilik';

    protected static ?string $pluralModelLabel = 'Daftar Identitas';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return IdentitasPemilikForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IdentitasPemiliksTable::configure($table);
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
            'index' => ListIdentitasPemiliks::route('/'),
            'create' => CreateIdentitasPemilik::route('/create'),
            'edit' => EditIdentitasPemilik::route('/{record}/edit'),
        ];
    }
}
