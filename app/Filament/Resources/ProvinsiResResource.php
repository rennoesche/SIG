<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProvinsiResResource\Pages;
use App\Filament\Resources\ProvinsiResResource\RelationManagers;
use App\Models\Provinsi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class ProvinsiResResource extends Resource
{
    protected static ?string $model = Provinsi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
                    TextInput::make('nama')
                        ->required()
                        ->string(),

                    TextInput::make('populasi')
                        ->nullable()
                        ->numeric()
                        ->step(1)
                        ->autofocus(),

                    TextInput::make('latitude')
                        ->nullable()
                        ->numeric()
                        ->step(1),

                    TextInput::make('longitude')
                        ->nullable()
                        ->numeric()
                        ->step(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                TextColumn::make('nama'),

                TextColumn::make('populasi'),

                TextColumn::make('latitude'),

                TextColumn::make('longitude'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
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
            'index' => Pages\ListProvinsiRes::route('/'),
            'create' => Pages\CreateProvinsiRes::route('/create'),
            'edit' => Pages\EditProvinsiRes::route('/{record}/edit'),
        ];
    }
}
