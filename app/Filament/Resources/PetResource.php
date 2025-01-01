<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetResource\Pages;
use App\Filament\Resources\PetResource\RelationManagers;
use App\Models\Pet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PetResource extends Resource
{
    protected static ?string $model = Pet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Nombre')
                ->minLength(2)
                ->maxLength(50)
                ->required(),
            Forms\Components\Select::make('type')->options([
                'dog' => 'Perro',
                'cat' => 'Gato',
            ]) 
                ->label('Tipo')
                ->required(),
            Forms\Components\TextInput::make('breed')
                ->label('Raza')
                ->minLength(2)
                ->maxLength(50),
            Forms\Components\Datepicker::make('date_of_birth')
                ->label('Nacimiento')
                ->mask('99/99/9999')
                ->placeholder('DD/MM/YYYY')
                ->required(),
            Forms\Components\TextInput::make('weight')
                ->label('Peso')
                ->numeric()
                ->inputMode('decimal'),
            
            Forms\Components\Select::make('owner_id')
                ->label('Dueño')
                ->relationship('owner', 'name')
                ->visible(fn ($request) => $request->user()->isAdmin() || $request->user()->isVet())
                ->searchable()
                ->required(),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label('Nombre')
                    ->searchable(),
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
            'index' => Pages\ListPets::route('/'),
            'create' => Pages\CreatePet::route('/create'),
            'edit' => Pages\EditPet::route('/{record}/edit'),
        ];
    }
}
