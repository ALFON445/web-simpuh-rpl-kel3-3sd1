<?php

namespace App\Filament\Resources\LaporanResource\Pages;

use App\Filament\Resources\LaporanResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLaporan extends CreateRecord
{
    protected static string $resource = LaporanResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirect ke daftar laporan setelah berhasil membuat laporan
        return route('filament.resources.laporan.index');
    }
}
