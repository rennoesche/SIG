<?php

namespace App\Filament\Resources\Panel;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use App\Models\Kabkota;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Panel\KabkotaResource\Pages;
use App\Filament\Resources\Panel\KabkotaResource\RelationManagers;

class KabkotaResource extends Resource
{
    protected static ?string $model = Kabkota::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Admin';

    public static function getModelLabel(): string
    {
        return __('crud.kabkotas.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('crud.kabkotas.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return __('crud.kabkotas.collectionTitle');
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
                        ->step(1),

                    TextInput::make('kodepos')
                        ->nullable()
                        ->numeric()
                        ->step(1),

                    TextInput::make('kecamatan')
                        ->nullable()
                        ->numeric()
                        ->step(1),

                    TextInput::make('desa')
                        ->nullable()
                        ->numeric()
                        ->step(1),

                    TextInput::make('islam')
                        ->nullable()
                        ->numeric()
                        ->step(1),

                    TextInput::make('kristen')
                        ->nullable()
                        ->numeric()
                        ->step(1),

                    TextInput::make('katolik')
                        ->nullable()
                        ->numeric()
                        ->step(1),

                    TextInput::make('hindu')
                        ->nullable()
                        ->numeric()
                        ->step(1),

                    TextInput::make('pk_petani')
                        ->nullable()
                        ->numeric()
                        ->step(1),

                    TextInput::make('pk_nelayan')
                        ->nullable()
                        ->numeric()
                        ->step(1),

                    TextInput::make('pk_pedagang')
                        ->nullable()
                        ->numeric()
                        ->step(1),

                    TextInput::make('pk_asn')
                        ->nullable()
                        ->numeric()
                        ->step(1),

                    Select::make('provinsi_id')
                        ->required()
                        ->relationship('provinsi', 'nama')
                        ->searchable()
                        ->preload()
                        ->native(false),
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

                TextColumn::make('kodepos'),

                TextColumn::make('kecamatan'),

                TextColumn::make('desa'),

                TextColumn::make('islam'),

                TextColumn::make('kristen'),

                TextColumn::make('katolik'),

                TextColumn::make('hindu'),

                TextColumn::make('pk_petani'),

                TextColumn::make('pk_nelayan'),

                TextColumn::make('pk_pedagang'),

                TextColumn::make('pk_asn'),

                TextColumn::make('provinsi.nama'),
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
            'index' => Pages\ListKabkotas::route('/'),
            'create' => Pages\CreateKabkota::route('/create'),
            'view' => Pages\ViewKabkota::route('/{record}'),
            'edit' => Pages\EditKabkota::route('/{record}/edit'),
        ];
    }
}
