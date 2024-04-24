<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormInputResource\Pages;
use App\Filament\Resources\FormInputResource\RelationManagers;
use App\Models\CenterCode;
use App\Models\FormInput;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class FormInputResource extends Resource
{
    protected static ?string $model = FormInput::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('center_code_id')
                    ->relationship('centerCode', 'code')
                    ->searchable()
                    ->preload()
                    ->noSearchResultsMessage('No Center Found')
                    ->required(),
                Forms\Components\Select::make('insurance_id')
                    ->relationship('insurance', 'insurance')
                    ->required(),
                Forms\Components\Select::make('products_id')
                    ->relationship('products', 'products')
                    ->required(),
                Forms\Components\TextInput::make('patient_phone')
                    ->prefix("+1")
                    ->tel()
                    ->length(10)
                    ->maxLength(15)
                    ->required(),
                Forms\Components\TextInput::make('secondary_phone')
                    ->prefix("+1")
                    ->tel()
                    ->maxLength(15)
                    ->default(null),
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(15),
                Forms\Components\DatePicker::make('dob')
                    ->required(),
                Forms\Components\TextInput::make('medicare_id')
                    ->unique()
                    ->validationMessages([
                        'unique' => 'The Medicare Id is already present'
                    ])
                    ->required()
                    ->maxLength(15),
                Forms\Components\Textarea::make('address')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('state')
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('zip')
                    ->required()
                    ->maxLength(15),
                Forms\Components\Textarea::make('product_specs')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('doctor_name')
                    ->required()
                    ->maxLength(30),
                Forms\Components\TextInput::make('facility_name')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('patient_last_visit')
                    ->required()
                    ->maxLength(20),
                Forms\Components\Textarea::make('doctor_address')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('doctor_phone')
                    ->tel()
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('doctor_fax')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('doctor_npi')
                    ->required()
                    ->maxLength(50),
                Forms\Components\Textarea::make('recording_link')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('comments')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $name = Auth::user()->name;
                $center_code_id = CenterCode::where('code', $name)->first();
                if ($center_code_id) {
                    $id = $center_code_id->id;
                    $query->where('center_code_id', $id)
                        ->orderBy('id', 'desc');
                }
                $query->where('status', '!=', 'paid');
            })
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('status')
                    ->badge('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transfer_status')
                    ->badge('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('centerCode.code')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('insurance.insurance')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('products.products')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('patient_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('secondary_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('medicare_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip')
                    ->searchable(),
                Tables\Columns\TextColumn::make('doctor_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('facility_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('patient_last_visit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('doctor_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('doctor_fax')
                    ->searchable(),
                Tables\Columns\TextColumn::make('doctor_npi')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Denied' => 'Denied',
                        'Error' => 'Error',
                        'Payable' => 'Payable',
                        'Approved' => 'Approved',
                        'Wrong doc' => 'Wrong doc',
                        'Paid' => 'Paid',
                    ])
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListFormInputs::route('/'),
            'create' => Pages\CreateFormInput::route('/create'),
            'edit' => Pages\EditFormInput::route('/{record}/edit'),
        ];
    }
    public static function canEdit(Model $record): bool
    {
        return false;
    }
}
