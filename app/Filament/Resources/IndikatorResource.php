<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndikatorResource\Pages;
use App\Filament\Resources\IndikatorResource\RelationManagers;
use App\Models\Indikator;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IndikatorResource extends Resource
{
    protected static ?string $model = Indikator::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    protected static ?string $navigationGroup = 'Indikator Kekumuhan';
    
    protected static ?string $navigationLabel = 'Indikator';

    protected static ?string $modelLabel = 'Indikator Kumuh';

    protected static ?string $pluralModelLabel = 'Indikator Kumuh';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'indikator';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_indikator')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_indikator')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('persentase')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('tahun')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('desa_id')
                    ->relationship('desa', 'nama_desa')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_indikator')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_indikator')
                    ->searchable(),
                Tables\Columns\TextColumn::make('persentase')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tahun')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kode_desa')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('desa.nama_desa')
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
            'index' => Pages\ListIndikators::route('/'),
            'create' => Pages\CreateIndikator::route('/create'),
            'edit' => Pages\EditIndikator::route('/{record}/edit'),
        ];
    }
}
