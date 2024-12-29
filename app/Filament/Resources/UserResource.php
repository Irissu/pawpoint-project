<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form // lo que se muestra en el formulario
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table // lo que se muestra en la tabla
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('role'),
            ])
            ->filters([ // filtros
                //
            ])
            ->actions([ // acciones, como por ejemplo editar o eliminar
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([ // acciones en masa, como por ejemplo eliminar varios registros a la vez
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array // relaciones con otras tablas, las ponemos aqui para que se muestren. 
    {
        return [
            //
        ];
    }

    public static function getPages(): array // paginas que se muestran en el menu de la izquierda
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
