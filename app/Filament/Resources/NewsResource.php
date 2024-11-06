<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\News;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Columns;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\NewsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NewsResource\Pages\EditNews;
use App\Filament\Resources\NewsResource\Pages\ListNews;
use App\Filament\Resources\NewsResource\Pages\CreateNews;
use App\Filament\Resources\NewsResource\RelationManagers;
use Filament\Tables\Columns\TextColumn\TextColumnSize;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
                    ->schema([

                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),


                        Textarea::make('content')
                            ->required()
                            ->columnSpan(2)->autosize(), // Span across both columns if using two-column layout

                        FileUpload::make('image_url')
                            ->label('Image')
                            ->image()
                            ->columnSpan(2) // Use 2 columns if available
                            ->nullable(),

                        Hidden::make('author_id')->default(fn() => Auth::id()),


                    ]),



                Section::make('Publication Details')
                    ->schema([

                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                            ])
                            ->default('draft')
                            ->required()
                            ->columnSpan(2),
                    ]),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('image_url')
                    ->label('Image')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('author.name')
                    ->label('Author')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('published_date')
                    ->label('Published Date')
                    ->getStateUsing(fn($record) => $record->published_date ? $record->published_date->format('F j, Y, g:i a') : 'None') // Replace null with "None" and format date
                    ->sortable(),

                TextColumn::make('category')
                    ->label('Category')
                    ->getStateUsing(fn($record) => $record->category ?? 'None') // Replace null with "None"
                    ->sortable()
                    ->searchable(),


                TextColumn::make('status')
                    ->badge()
                    ->label('Status')
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                    ])->formatStateUsing(fn(string $state): string => ucfirst($state))
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('F j, Y, g:i a') // Format: January 1, 2024, 12:00 pm
                    ->size(TextColumnSize::ExtraSmall)
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('F j, Y, g:i a') // Format: January 1, 2024, 12:00 pm
                    ->size(TextColumnSize::ExtraSmall)
                    ->sortable(),
            ])
            ->filters([
                // Add any necessary filters here
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }

}
