<?php

namespace App\Filament\Resources\Panel;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Provinsi;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Panel\ProvinsiResource\Pages;
use App\Filament\Resources\Panel\ProvinsiResource\RelationManagers;

class ProvinsiResource extends Resource
{
    protected static ?string $model = Provinsi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Admin';

    public static function getModelLabel(): string
    {
        return __('crud.provinsis.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('crud.provinsis.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return __('crud.provinsis.collectionTitle');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 1])->schema([
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
                ]),
            ]),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProvinsis::route('/'),
            'create' => Pages\CreateProvinsi::route('/create'),
            'view' => Pages\ViewProvinsi::route('/{record}'),
            'edit' => Pages\EditProvinsi::route('/{record}/edit'),
        ];
    }
}
