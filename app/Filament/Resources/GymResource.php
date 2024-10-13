<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GymResource\Pages;
use App\Filament\Resources\GymResource\RelationManagers;
use App\Models\City;
use App\Models\Facility;
use App\Models\Gym;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GymResource extends Resource
{
    protected static ?string $model = Gym::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('address')
                            ->required()
                            ->rows(3)
                            ->maxLength(255),

                        FileUpload::make('thumbnail')
                            ->image()
                            ->required(),

                        Repeater::make('gymPhotos')
                            ->relationship('gymPhotos')
                            ->schema([
                                FileUpload::make('photo')
                                    ->image()
                                    ->required(),
                            ]),
                ]),

                Fieldset::make('Additionals')
                    ->schema([
                        Textarea::make('about')
                            ->required(),

                        Repeater::make('gymFacilities')
                            ->relationship('gymFacilities')
                            ->schema([
                                Select::make('facility_id')
                                    ->label('Gym Facility')
                                    ->options(Facility::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),
                            ]),

                        Select::make('is_popular')
                            ->required()
                            ->options(options: [
                                true => 'Popular',
                                false => 'Not Popular',
                            ]),

                        Select::make('city_id')
                            ->relationship('city', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),

                        TimePicker::make('open_time_at')
                                ->required(),

                        TimePicker::make('closed_time_at')
                                ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('city.name')
                    ->label('City')
                    ->searchable(),

                ImageColumn::make('thumbnail'),

                IconColumn::make('is_popular')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Popular'),
            ])
            ->filters([
                SelectFilter::make('city_id')
                    ->relationship('city', 'name')
                    ->label('City'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListGyms::route('/'),
            'create' => Pages\CreateGym::route('/create'),
            'edit' => Pages\EditGym::route('/{record}/edit'),
        ];
    }
}
