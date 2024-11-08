<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Panel;
use Filament\Tables;
use App\Models\Carousel;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use App\Filament\Resources\CarouselResource\Pages;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CarouselResource extends Resource
{
    protected static ?string $model = Carousel::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Content Management';



    // Menampilkan form di halaman index untuk satu record pertama
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3) // 3 kolom untuk setiap FileUpload
                    ->schema([
                        Forms\Components\FileUpload::make('first')
                            ->required()
                            ->label('First Carousel')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',

                            ]),

                        Forms\Components\FileUpload::make('second')
                            ->required()
                            ->label('Second Carousel')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',

                            ]),

                        Forms\Components\FileUpload::make('third')
                            ->required()
                            ->label('Third Carousel')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                            ])

                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarousels::route('/'), // Mengarahkan halaman awal ke form edit langsung
            'edit' => Pages\EditCarousel::route('/{record}/edit'), // Mengarahkan halaman awal ke form edit langsung
        ];
    }
}
