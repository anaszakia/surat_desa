<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use App\Models\Ttd;
use Filament\Forms;
use Filament\Tables;
use App\Models\Surat;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Forms\Components\Select;
use App\Models\KategoriSurat;
use Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
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
                    ->numeric()
                    ->mask('9999999999999999')
                    ->label('NIK')
                    ->maxLength(20),
                Forms\Components\TextInput::make('tempat_lahir')
                    ->required()
                    ->label('Tempat Lahir')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->required()
                    ->label('Tanggal Lahir'),
                Forms\Components\Select::make('agama')
                    ->options([
                        'ISLAM' => 'ISLAM',
                        'KRISTEN PROTESTAN' => 'KRISTEN PROTESTAN',
                        'KRISTEN KATOLIK' => 'KRISTEN KATOLIK',
                        'HINDU' => 'HINDU',
                        'BUDHA' => 'BUDHA',
                        'KONGHUCU' => 'KONGHUCU'
                    ])
                    ->required()
                    ->label('Agama'),
                Forms\Components\Select::make('jenis_kelamin')
                    ->options([
                        'LAKI-LAKI' => "LAKI-LAKI",
                        'PEREMPUAN' => "PEREMPUAN"
                    ])
                    ->required()
                    ->label('Jenis Kelamin'),
                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->label('Alamat')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('pekerjaan')
                    ->required()
                    ->label('Pekerjaan'),
                 Forms\Components\DatePicker::make('tanggal_terbit')
                    ->label('Tanggal Terbit')
                    ->default(fn () => now())
                    ->required(),
                Forms\Components\TextInput::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->disabled()
                    ->placeholder('Otomatis Generate (tidak usah di isi)')
                    ->dehydrated(false)
                    ->default(fn () => null),
                Forms\Components\TextInput::make('keperluan')
                    ->label('Keperluan'),
                Forms\Components\TextInput::make('data_lainnya'),
                Forms\Components\Select::make('ttd_id')
                    ->required()
                    ->options(Ttd::all()->pluck('nama', 'id'))
                    ->label('Penandatangan')
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
               Tables\Actions\Action::make('cetak_surat')
                ->label('Cetak Surat')
                ->url(function ($record) {
                    return route('surat.cetak', [
                        'id' => $record->id,
                        'template' => 'keterangan_tidak_mampu', // Semua diarahkan ke template ini
                    ]);
                })
                ->openUrlInNewTab()
                ->icon('heroicon-o-printer')
                ->color('success'),
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
