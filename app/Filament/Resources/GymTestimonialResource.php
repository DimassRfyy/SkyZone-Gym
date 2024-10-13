<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GymTestimonialResource\Pages;
use App\Filament\Resources\GymTestimonialResource\RelationManagers;
use App\Models\GymTestimonial;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GymTestimonialResource extends Resource
{
    protected static ?string $model = GymTestimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('occupation')
                    ->required()
                    ->maxLength(255),

                Select::make('gym_id')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->relationship('gym', 'name'),

                FileUpload::make('photo')
                        ->image()
                        ->required(),

                Textarea::make('message')
                    ->required()
                    ->rows(3)
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->circular( ),

                TextColumn::make('name')
                    ->searchable(),

                ImageColumn::make('gym.thumbnail')
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
            'index' => Pages\ListGymTestimonials::route('/'),
            'create' => Pages\CreateGymTestimonial::route('/create'),
            'edit' => Pages\EditGymTestimonial::route('/{record}/edit'),
        ];
    }
}
