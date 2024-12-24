<?php

namespace App\Filament\Resources\LaporanResource\Pages;

use App\Filament\Resources\LaporanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporan extends EditRecord
{
    protected static string $resource = LaporanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(), // Tombol delete di halaman edit
        ];
    }

    protected function getRedirectUrl(): string
    {
        // Redirect setelah delete ke halaman list laporan
        return route('filament.resources.laporan.index');
    }
}
