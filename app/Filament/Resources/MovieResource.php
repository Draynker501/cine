<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovieResource\Pages;
use App\Filament\Resources\MovieResource\RelationManagers;
use App\Models\Movie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('duration')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('classification')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('genre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('synopsis')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                // Configuración para subir el póster y el tráiler
                Forms\Components\FileUpload::make('poster')
                    ->image() // asegura que sea imagen
                    ->directory('posters') // carpeta dentro de storage/app/public/movies/poster
                    ->imagePreviewHeight('250') // preview
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(2048), // 2MB,
                Forms\Components\FileUpload::make('trailer')
                    ->directory('trailers')
                    ->acceptedFileTypes(['video/mp4'])
                    ->maxSize(4194304), // 4GB 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('classification')
                    ->searchable(),
                Tables\Columns\TextColumn::make('genre')
                    ->searchable(),
                // Muestra una miniatura del póster
                Tables\Columns\ImageColumn::make('poster')
                    ->label('Poster')
                    ->square()
                    ->height(60)
                    ->width(40),
                // Muestra un enlace al tráiler respectivo
                Tables\Columns\TextColumn::make('trailer')
                    ->label('Trailer')
                    ->url(fn($record) => $record->trailer ? Storage::url($record->trailer) : null, true)
                    ->openUrlInNewTab()
                    ->formatStateUsing(fn($state) => $state ? 'Ver Trailer' : '-'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
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
            'index' => Pages\ListMovies::route('/'),
            'create' => Pages\CreateMovie::route('/create'),
            'edit' => Pages\EditMovie::route('/{record}/edit'),
        ];
    }
}
