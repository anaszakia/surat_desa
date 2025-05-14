<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Surat;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\KategoriSurat;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SuratResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SuratResource\RelationManagers;

class SuratResource extends Resource
{
    protected static ?string $model = Surat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Buat Surat';
    protected static ?string $navigationGroup = 'Manajemen Surat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kategori_surat_id')
                    ->label('Kategori Surat')
                    ->required()
                    ->options(KategoriSurat::all()->pluck('nama', 'id')),
                Forms\Components\TextInput::make('nama_lengkap')
                    ->required()
                    ->label('Nama Lengkap')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nik')
                    ->required()
                    ->label('NIK')
                    ->maxLength(20),
                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->label('Alamat')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('tanggal_terbit')
                    ->label('Tanggal Terbit')
                    ->default(fn () => now())
                    ->required(),
                Forms\Components\TextInput::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->disabled()
                    ->dehydrated(false)
                    ->default(fn () => null), // biarkan kosong, diisi otomatis di model saat saving
                Forms\Components\TextInput::make('data_lainnya'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kategori_surat_id')
                    ->label('Kategori Surat')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_terbit')
                    ->label('Tanggal Terbit')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nomor_surat')
                    ->label('Nomor Surat')
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
            'index' => Pages\ListSurats::route('/'),
            'create' => Pages\CreateSurat::route('/create'),
            'edit' => Pages\EditSurat::route('/{record}/edit'),
        ];
    }
}
