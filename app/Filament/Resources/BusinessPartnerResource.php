<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessPartnerResource\Pages;
use App\Filament\Resources\BusinessPartnerResource\RelationManagers;
use App\Models\BusinessPartner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusinessPartnerResource extends Resource
{
    protected static ?string $model = BusinessPartner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->required(),
                Forms\Components\TextInput::make('first_name'),
                Forms\Components\TextInput::make('last_name'),
                Forms\Components\TextInput::make('company_name'),
                Forms\Components\TextInput::make('business_partner_name'),
                Forms\Components\TextInput::make('company_number'),
                Forms\Components\TextInput::make('company_contact_person'),
                Forms\Components\TextInput::make('company_contact_number'),
                Forms\Components\TextInput::make('business_partner_type'),
                Forms\Components\TextInput::make('business_partner_category'),
                Forms\Components\TextInput::make('contact_number'),
                Forms\Components\TextInput::make('contact_email')
                    ->email(),
                Forms\Components\TextInput::make('website'),
                Forms\Components\Textarea::make('social_links')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('statuses')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
                Forms\Components\Toggle::make('is_company')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('business_partner_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_contact_person')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_contact_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('business_partner_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('business_partner_category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_company')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AddressesRelationManager::class,
            RelationManagers\InvoicesRelationManager::class,
            RelationManagers\OrdersRelationManager::class,
            RelationManagers\PaymentsRelationManager::class,
            RelationManagers\ShippingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBusinessPartners::route('/'),
            'create' => Pages\CreateBusinessPartner::route('/create'),
            'view' => Pages\ViewBusinessPartner::route('/{record}'),
            'edit' => Pages\EditBusinessPartner::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
