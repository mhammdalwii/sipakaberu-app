<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicinalPlantResource\Pages;
use App\Models\MedicinalPlant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class MedicinalPlantResource extends Resource
{
    protected static ?string $model = MedicinalPlant::class;
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'Manajemen Tanaman Obat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Tanaman')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar Tanaman')
                            ->image()
                            ->directory('plant-images')
                            ->columnSpanFull()
                            ->required()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                            ->maxSize(2048),

                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Tanaman'),

                        Forms\Components\TextInput::make('scientific_name')
                            ->maxLength(255)
                            ->label('Nama Ilmiah'),

                        Forms\Components\TextInput::make('slug')
                            ->disabled()
                            ->dehydrated(true) // pastikan dikirim walau disabled
                            ->default(fn($get) => \Illuminate\Support\Str::slug($get('name')))
                            ->helperText('Slug akan terisi otomatis berdasarkan nama tanaman.')
                            ->unique(ignoreRecord: true),
                    ])->columns(2),

                Forms\Components\Section::make('Detail Khasiat')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->label('Deskripsi Umum'),

                        Forms\Components\RichEditor::make('benefits')
                            ->label('Manfaat / Khasiat')
                            ->default(''),

                        Forms\Components\RichEditor::make('how_to_use')
                            ->label('Cara Penggunaan / Pengolahan')
                            ->default(''),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Gambar'),
                Tables\Columns\TextColumn::make('name')->searchable()->label('Nama Tanaman'),
                Tables\Columns\TextColumn::make('scientific_name')->searchable()->label('Nama Ilmiah'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = !empty($data['slug'])
            ? $data['slug']
            : Str::slug($data['name']);

        $data['benefits'] = $data['benefits'] ?? '';
        $data['how_to_use'] = $data['how_to_use'] ?? '';

        return $data;
    }

    protected static function mutateFormDataBeforeSave(array $data): array
    {
        $data['slug'] = !empty($data['slug'])
            ? $data['slug']
            : Str::slug($data['name']);

        $data['benefits'] = $data['benefits'] ?? '';
        $data['how_to_use'] = $data['how_to_use'] ?? '';

        return $data;
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
            'index' => Pages\ListMedicinalPlants::route('/'),
            'create' => Pages\CreateMedicinalPlant::route('/create'),
            'edit' => Pages\EditMedicinalPlant::route('/{record}/edit'),
        ];
    }
}
