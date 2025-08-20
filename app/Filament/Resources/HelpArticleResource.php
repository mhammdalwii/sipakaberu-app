<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HelpArticleResource\Pages;
use App\Models\HelpArticle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HelpArticleResource extends Resource
{
    protected static ?string $model = HelpArticle::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationLabel = 'Panduan';
    protected static ?string $pluralModelLabel = 'Panduan';
    protected static ?string $modelLabel = 'Panduan';
    protected static ?string $navigationGroup = 'Manajemen Pusat Bantuan';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Artikel'),

                Forms\Components\TextInput::make('slug')
                    ->disabled()
                    ->helperText('Slug akan dibuat otomatis dari judul saat disimpan.'),

                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->label('Konten Panduan')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHelpArticles::route('/'),
            'create' => Pages\CreateHelpArticle::route('/create'),
            'edit' => Pages\EditHelpArticle::route('/{record}/edit'),
        ];
    }
}
