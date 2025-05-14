<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriSuratResource\Pages;
use App\Filament\Resources\KategoriSuratResource\RelationManagers;
use App\Models\KategoriSurat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriSuratResource extends Resource
{
    protected static ?string $model = KategoriSurat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Kategori Surat';
    protected static ?string $navigationGroup = 'Manajemen Surat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->placeholder('Masukkan kategori surat')
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->placeholder('Masukkan deskripsi (tidak wajib')
                    ->maxLength(255),
                Forms\Components\TextInput::make('kode')
                    ->required()
                    ->placeholder('Masukkan kode cth:I,II,III,IV dst')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode')
                    ->searchable(),
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
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                ->label('Lihat'),
                Tables\Actions\EditAction::make()
                ->label('Ubah'),
                Tables\Actions\DeleteAction::make()
                ->label('Hapus'),
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
            'index' => Pages\ListKategoriSurats::route('/'),
            'create' => Pages\CreateKategoriSurat::route('/create'),
            'edit' => Pages\EditKategoriSurat::route('/{record}/edit'),
        ];
    }
}
