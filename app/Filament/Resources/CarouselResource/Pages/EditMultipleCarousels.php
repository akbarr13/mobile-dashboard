<?php

namespace App\Filament\Resources\CarouselResource\Pages;

use App\Filament\Resources\CarouselResource;
use Filament\Resources\Pages\Page;
use App\Models\Carousel;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms;

class EditMultipleCarousels extends Page implements HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static string $resource = CarouselResource::class;

    // Pastikan view ini mengarah ke file Blade yang valid
    protected static string $view = 'filament.resources.carousel.edit-multiple';

    public $carousel;

    public function mount()
    {
        // Ambil record pertama dari database
        $this->carousel = Carousel::firstOrFail();

    

        // Isi form dengan data dari record pertama
        $this->form->fill($this->carousel->toArray());
    }

    public function save()
    {
        // Simpan perubahan ke database
        $this->carousel->update($this->form->getState());

        $this->notify('success', 'Carousel updated successfully.');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\FileUpload::make('first')
            ->label('First Image')
            ->image(),

            Forms\Components\FileUpload::make('second')
                ->required()
                ->label('Second Carousel'),

            Forms\Components\FileUpload::make('third')
                ->required()
                ->label('Third Carousel'),
        ];
    }
}
