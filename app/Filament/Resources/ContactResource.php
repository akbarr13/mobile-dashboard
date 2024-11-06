<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {


        return $form->schema([
            Forms\Components\Fieldset::make('Contact Information')
                ->schema([
                    TextInput::make('office_no')
                        ->label('Office Number')
                        ->placeholder('Enter office number')
                        ->required(),
                    TextInput::make('phone_number')
                        ->label('Phone Number')
                        ->placeholder('Enter phone number')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email Address')
                        ->placeholder('Enter email address')
                        ->email()
                        ->required(),
                ]),

            Forms\Components\Fieldset::make('Office Details')
                ->schema([
                    TextInput::make('main_office_name')
                        ->label('Main Office Name')
                        ->placeholder('Enter main office name')
                        ->required(),
                    TextInput::make('nat_branch_office')
                        ->label('National Branch Office')
                        ->placeholder('Enter national branch office'),
                    TextInput::make('inter_branch_office')
                        ->label('International Branch Office')
                        ->placeholder('Enter international branch office'),
                ]),

            Forms\Components\Fieldset::make('Location Coordinates')
                ->schema([
                    Forms\Components\TextInput::make('latitude')
                        ->label('Latitude')
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                            $set('location', [
                                'lat' => floatVal($state),
                                'lng' => floatVal($get('longitude')),
                            ]);
                        })
                        ->lazy()
                        ->readOnly(true)
                        ->placeholder('Auto-generated latitude'),
                    Forms\Components\TextInput::make('longitude')
                        ->label('Longitude')
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                            $set('location', [
                                'lat' => floatval($get('latitude')),
                                'lng' => floatVal($state),
                            ]);
                        })
                        ->lazy()
                        ->readOnly(true)
                        ->placeholder('Auto-generated longitude'),
                ]),

            Map::make('main_office')
                ->label('Office Location')
                ->defaultLocation(fn($record) => [
                    'lat' => $record->latitude ?? 0,
                    'lng' => $record->longitude ?? 0,
                ])
                ->autocomplete('main_office_name')
                ->autocompleteReverse(true)
                ->defaultZoom(10)
                ->mapControls([
                    'zoomControl' => true,
                    'mapTypeControl' => true,
                    'fullscreenControl' => true,
                ])
                ->reactive()
                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                    $set('latitude', $state['lat']);
                    $set('longitude', $state['lng']);
                })
                ->clickable(true)

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
