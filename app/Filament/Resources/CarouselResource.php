<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Panel;
use Filament\Tables;
use App\Models\Carousel;
use Filament\Forms\Form;
use Filament\Tables\Table;
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
            Forms\Components\Grid::make()
                ->columns(3) // Specify the number of columns
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->label('Carousel Name') // Add a label for clarity
                        ->placeholder('Enter carousel name'), // Add a placeholder for user guidance

                    Forms\Components\FileUpload::make('image_name') // Updated to 'image_name'
                        ->image()
                        ->required()
                        ->maxSize(2048) // Limit file size to 2MB
                        ->label('Carousel Image') // Add a label for clarity
                        ->placeholder('Upload an image'), // Add a placeholder for user guidance

                    Forms\Components\Textarea::make('description')
                        ->required()
                        ->label('Description') // Add a label for clarity
                        ->placeholder('Enter a description for the carousel') // Add a placeholder for user guidance
                        ->maxLength(500) // Optional: Limit the description length
                        ->rows(3), // Set the number of visible rows for the textarea
                ]),
        ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('ID') // Add a label for clarity
                    ->searchable(), // Make the ID searchable if needed

                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->label('Carousel Name') // Add a label for clarity
                    ->searchable() // Allow searching by name
                    ->limit(50), // Limit the display length

                Tables\Columns\ImageColumn::make('image_name') // This will display the image
                    ->label('Image')
                    ->disk('public') // Specify the disk if necessary
                    ->height(100) // Set the height of the image
                    ->width(100) // Set the width of the image
                    ->square() // Optional: make the image square
                    ->alt('Carousel Image'), // Add alt text for accessibility

                Tables\Columns\TextColumn::make('description')
                    ->label('Description') // Add a label for clarity
                    ->limit(50) // Limit the display length
                    ->searchable(), // Allow searching by description

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At') // Add a label for clarity
                    ->dateTime() // Format as date and time
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At') // Add a label for clarity
                    ->dateTime() // Format as date and time
                    ->sortable(),
            ])
            ->filters([
                // You can add filters here if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit'), // Add a label for clarity
                Tables\Actions\DeleteAction::make()
                    ->label('Delete'), // Add a label for clarity
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->label('Delete Selected'), // Add a label for clarity
            ])
            ->defaultSort('created_at', 'desc') // Default sorting by created_at in descending order
            ->pagination(10); // Set pagination to 10 items per page
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarousels::route('/'), // Mengarahkan halaman awal ke form edit langsung
            'edit' => Pages\EditCarousel::route('/{record}/edit'), // Mengarahkan halaman awal ke form edit langsung
        ];
    }
}
