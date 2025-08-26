<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PosyanduResource\Pages;
use App\Models\Posyandu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PosyanduResource extends Resource
{
    protected static ?string $model = Posyandu::class;

    protected static ?string $modelLabel = 'Posyandu';
    protected static ?string $pluralModelLabel = 'Posyandu';
    protected static ?string $navigationLabel = 'Posyandu';

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Manajemen Jadwal & Layanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Posyandu')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Posyandu'),

                        Forms\Components\Textarea::make('address')
                            ->required()
                            ->label('Alamat Lengkap')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('village')
                            ->required()
                            ->maxLength(255)
                            ->label('Kelurahan / Desa'),

                        Forms\Components\TextInput::make('sub_district')
                            ->required()
                            ->maxLength(255)
                            ->label('Kecamatan'),
                    ])->columns(2),

                Forms\Components\Section::make('Jadwal dan Kontak')
                    ->schema([
                        Forms\Components\TextInput::make('schedule_day')
                            ->maxLength(255)
                            ->label('Hari Pelayanan (Cth: Setiap Selasa)'),

                        Forms\Components\TextInput::make('schedule_time')
                            ->maxLength(255)
                            ->label('Jam Pelayanan (Cth: 08:00 - 11:00)'),

                        Forms\Components\TextInput::make('contact_person')
                            ->maxLength(255)
                            ->label('Nama Kader / Kontak'),

                        Forms\Components\TextInput::make('phone_number')
                            ->tel()
                            ->maxLength(255)
                            ->label('No. Telepon'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nama Posyandu'),
                Tables\Columns\TextColumn::make('village')
                    ->searchable()
                    ->label('Kelurahan/Desa'),
                Tables\Columns\TextColumn::make('sub_district')
                    ->searchable()
                    ->label('Kecamatan'),
                Tables\Columns\TextColumn::make('schedule_day')
                    ->label('Hari'),
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
            'index' => Pages\ListPosyandus::route('/'),
            'create' => Pages\CreatePosyandu::route('/create'),
            'edit' => Pages\EditPosyandu::route('/{record}/edit'),
        ];
    }
}
