<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function mount(): void
    {
        // Redirect langsung ke halaman edit ID 1
        redirect()->to('admin/contacts/1/edit');
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        // Render halaman hanya sebagai fallback agar tidak terjadi error
        return parent::render();
    }
}
