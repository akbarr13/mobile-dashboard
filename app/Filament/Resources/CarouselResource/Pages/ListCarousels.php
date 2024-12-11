<?php

namespace App\Filament\Resources\CarouselResource\Pages;

use App\Filament\Resources\CarouselResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Http\RedirectResponse;

class ListCarousels extends ListRecords
{
    protected static string $resource = CarouselResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function mount(): void
    {
        // Redirect langsung ke halaman edit ID 1
       
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        // Render halaman hanya sebagai fallback agar tidak terjadi error
        return parent::render();
    }
}
