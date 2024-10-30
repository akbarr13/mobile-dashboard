<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContact extends EditRecord
{
    protected static string $resource = ContactResource::class;


    public function mount($record): void
    {
        parent::mount($record);

        // Dump the record data to see what is being passed to the form
        $record = $this->getRecord();
 
    }
}
