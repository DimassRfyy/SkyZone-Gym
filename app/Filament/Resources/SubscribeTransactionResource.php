<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscribeTransactionResource\Pages;
use App\Filament\Resources\SubscribeTransactionResource\RelationManagers;
use App\Models\SubscribePackage;
use App\Models\SubscribeTransaction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubscribeTransactionResource extends Resource
{
    protected static ?string $model = SubscribeTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([

                    Step::make('Product and Price')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    Select::make('subscribe_package_id')
                                        ->required()
                                        ->relationship('subscribePackage', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->live()
                                        ->afterStateUpdated(function ($state, callable $set) {
                                            $subscribePackage = SubscribePackage::find($state);
                                            $price = $subscribePackage ? $subscribePackage->price : 0;
                                            $duration = $subscribePackage ? $subscribePackage->duration : 0;

                                            $set('price', $price);
                                            $set('duration', $duration);

                                            $tax = 0.11;
                                            $totalTaxAmount = $price * $tax;
                                            $totalAmount = $price + $totalTaxAmount;
                                            $set('total_amount', number_format($totalAmount, 0, '.', ''));
                                            $set('total_tax_amount', number_format($totalTaxAmount, 0, '.', ''));

                                            $startedAt = now()->format('Y-m-d');
                                            $set('started_at', $startedAt);

                                            $endedAt = now()->addDays($duration)->format('Y-m-d');
                                            $set('ended_at', $endedAt);
                                        })
                                        ->afterStateHydrated(function ($state, callable $set, callable $get) {
                                            $subscribePackageId = $state;
                                            if($subscribePackageId){
                                                $subscribePackage = SubscribePackage::find($subscribePackageId);
                                                $price = $subscribePackage ? $subscribePackage->price : 0;
                                                $set('price', $price);

                                                $tax = 0.11;
                                                $totalTaxAmount = $price * $tax;
                                                $set('total_tax_amount' , number_format($totalTaxAmount, 0,'.',''));
                                            }
                                        }),

                                    TextInput::make('price')
                                        ->required()
                                        ->numeric()
                                        ->prefix('IDR')
                                        ->readOnly(),

                                    TextInput::make('total_amount')
                                        ->required()
                                        ->numeric()
                                        ->prefix('IDR')
                                        ->readOnly(),

                                    TextInput::make('total_tax_amount')
                                        ->required()
                                        ->numeric()
                                        ->prefix('IDR')
                                        ->readOnly(),

                                    DatePicker::make('started_at')
                                        ->required()
                                        ->readOnly(),

                                    DatePicker::make('ended_at')
                                        ->required()
                                        ->readOnly(),

                                    TextInput::make('duration')
                                        ->required()
                                        ->numeric()
                                        ->prefix('Days')
                                        ->readOnly(),
                                ]),
                        ]),

                    Step::make('Customer Information')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('email')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('phone')
                                ->required()
                                ->maxLength(255),
                        ]),

                    Step::make('Payment Information')
                        ->schema([
                            TextInput::make('booking_trx_id')
                                ->required()
                                ->maxLength(255),

                            ToggleButtons::make('is_paid')
                                ->label('Apakah sudah membayar?')
                                ->boolean()
                                ->grouped()
                                ->icons([
                                    true => 'heroicon-o-pencil',
                                    false => 'heroicon-o-clock',
                                ])
                                ->required(),

                            FileUpload::make('proof')
                                ->image()
                                ->required(),
                        ])
                ])
                ->columnSpan('full')
                ->columns(1)
                ->skippable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('subscribePackage.icon'),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('booking_trx_id')
                    ->searchable(),

                IconColumn::make('is_paid')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Terverifikasi'),
            ])
            ->filters([
                SelectFilter::make('subscribe_package_id')
                    ->relationship('subscribePackage', 'name')
                    ->label('Subscribe Package'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->action(function (SubscribeTransaction $record){
                        $record->is_paid = true;
                        $record->save();

                        // Notification
                        Notification::make()
                            ->title('Transaction Approved')
                            ->success()
                            ->body('Transaction has been approved successfully')
                            ->send();
                    })
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn(SubscribeTransaction $record) => !$record->is_paid),

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
            'index' => Pages\ListSubscribeTransactions::route('/'),
            'create' => Pages\CreateSubscribeTransaction::route('/create'),
            'edit' => Pages\EditSubscribeTransaction::route('/{record}/edit'),
        ];
    }
}
