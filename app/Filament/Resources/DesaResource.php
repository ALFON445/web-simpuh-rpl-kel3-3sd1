<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DesaResource\Pages;
use App\Filament\Resources\DesaResource\RelationManagers;
use App\Models\Desa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DesaResource extends Resource
{
    protected static ?string $model = Desa::class;

    protected static ?string $navigationIcon = 'heroicon-c-globe-asia-australia';

    protected static ?string $navigationLabel = 'Desa';

    protected static ?string $navigationGroup = 'Monitor Data';

    protected static ?string $modelLabel = 'Desa';

    protected static ?string $pluralModelLabel = 'Desa';

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'desa';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_desa')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_desa')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('kecamatan_id')
                    ->relationship('kecamatan', 'nama_kecamatan')
                    ->searchable()
                    ->preload()
                    ->required()
                // Forms\Components\Select::make('kode_kecamatan')
                //     ->relationship('kecamatan', 'nama_kecamatan')
                //     ->searchable()
                //     ->preload()
                //     ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_desa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_desa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kecamatan.kode_kecamatan')
                    ->label('Kode Kecamatan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kecamatan.nama_kecamatan')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListDesas::route('/'),
            'create' => Pages\CreateDesa::route('/create'),
            'edit' => Pages\EditDesa::route('/{record}/edit'),
        ];
    }
}
