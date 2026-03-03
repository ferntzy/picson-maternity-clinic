<?php

namespace App\Filament\Resources\Profiles\Tables;

use App\Filament\Resources\Profiles\Schemas\ProfileForm;
use App\Filament\Resources\Profiles\Schemas\ProfileInfolist;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Filament\Notifications\Notification;

class ProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->where('role', 'patient'))
            ->columns([
                TextColumn::make('firstname')
                    ->label('Full Name')
                    ->getStateUsing(fn ($record) =>
                        trim("{$record->firstname} {$record->middlename} {$record->lastname}")
                    )
                    ->searchable([
                        'firstname',
                        'middlename',
                        'lastname',
                    ]),

                TextColumn::make('address')
                    ->label('Address'),

                TextColumn::make('contact_num')
                    ->label('Contact Number'),

            ])

            ->recordActions([
                ActionGroup::make([

                    EditAction::make()
                        ->label('Edit Patient Profile')
                        ->color('gray')
                        ->modalHeading('Edit Patient Profile')
                        ->modalDescription('Update the patient information below.')
                        ->modalWidth('6xl')
                        ->modalSubmitActionLabel('Save Patient Profile')
                        ->schema(fn ($form) => ProfileForm::configure($form)),

                    DeleteAction::make()
                        ->color('danger'),

                    ViewAction::make()
                        ->modalHeading('Patient Profile')
                        ->modalWidth('4xl')
                        ->modalSubmitAction(false)
                        ->modalCancelActionLabel('Close')
                        ->schema(fn ($infolist) => ProfileInfolist::configure($infolist)),

                    /*
                    |--------------------------------------------------------------------------
                    | DELIVERIES ACTION
                    |--------------------------------------------------------------------------
                    */
                    Action::make('deliveries')
                        ->label('Deliveries')
                        ->icon('heroicon-o-clipboard-document-list')
                        ->color('success')
                        ->modalHeading(fn ($record) =>
                            trim("{$record->firstname} {$record->middlename} {$record->lastname}")
                        )
                        ->modalWidth('5xl')
                        ->modalSubmitAction(false)
                        ->modalCancelActionLabel('Close')
                        ->modalContent(function ($record) {

                            $deliveries = $record->deliveries()->latest()->get();

                            if ($deliveries->isEmpty()) {
                                return new HtmlString(
                                    '<p class="text-gray-500 text-sm">No delivery records found.</p>'
                                );
                            }

                            $rows = $deliveries->map(function ($delivery) {
                                return "
                                    <tr>
                                        <td class='px-4 py-2 border'>{$delivery->type_of_delivery}</td>
                                        <td class='px-4 py-2 border'>
                                            " . \Carbon\Carbon::parse($delivery->delivery_date)->format('F d, Y h:i A') . "
                                        </td>
                                    </tr>
                                ";
                            })->implode('');

                            return new HtmlString("
                                <div class='mb-4 font-semibold text-sm'>
                                    Total Deliveries: {$deliveries->count()}
                                </div>

                                <div class='overflow-x-auto'>
                                    <table class='w-full border text-sm'>
                                        <thead class='bg-gray-100'>
                                            <tr>
                                                <th class='px-4 py-2 border'>Type of Delivery</th>
                                                <th class='px-4 py-2 border'>Time of Delivery</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {$rows}
                                        </tbody>
                                    </table>
                                </div>
                            ");
                        }),

                    /*
                    |--------------------------------------------------------------------------
                    | BIRTH EMERGENCY ACTION
                    |--------------------------------------------------------------------------
                    */
                    Action::make('birth_emergency')
                        ->label('Birth and Emergency')
                        ->icon('heroicon-o-exclamation-triangle')
                        ->color('warning')
                        ->modalHeading('Record Birth Emergency')
                        ->modalWidth('lg')
                        ->modalSubmitActionLabel('Save Emergency Record')
                        ->form([
                            \Filament\Forms\Components\DateTimePicker::make('occurred_at')
                                ->label('Date & Time of Emergency')
                                ->required()
                                ->default(now())
                                ->seconds(false),

                            \Filament\Forms\Components\Textarea::make('description')
                                ->label('Emergency Description')
                                ->rows(4)
                                ->required(),

                            \Filament\Forms\Components\Select::make('severity')
                                ->label('Severity Level')
                                ->options([
                                    'low'    => 'Low – Monitored',
                                    'medium' => 'Medium – Immediate attention',
                                    'high'   => 'High – Critical / Life-threatening',
                                ])
                                ->required(),

                            \Filament\Forms\Components\Select::make('outcome')
                                ->label('Immediate Outcome')
                                ->options([
                                    'stable'        => 'Mother & Baby Stable',
                                    'mother_stable' => 'Mother Stable, Baby Needs Care',
                                    'baby_stable'   => 'Baby Stable, Mother Needs Care',
                                    'both_critical' => 'Both Critical – Transferred',
                                    'deceased'      => 'Deceased',
                                ])
                                ->required(),

                            \Filament\Forms\Components\Textarea::make('notes')
                                ->label('Additional Notes / Follow-up')
                                ->rows(3),
                        ])
                        ->action(function (array $data, $record): void {
                            $record->birthEmergencies()?->create($data);

                            Notification::make()
                                ->title('Birth emergency recorded successfully')
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation()

                ])
                ->icon('heroicon-m-ellipsis-vertical')
                ->color('gray')
                ->tooltip('Options')
                ->iconButton(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])

            ->heading(
                new HtmlString('<h1 style="font-family: Poppins, sans-serif; font-weight: 700; font-size: 1.8rem;">Patient profiles</h1>')
            )

            ->headerActions([
                CreateAction::make('new_patient_profile')
                    ->label('New Patient Profile')
                    ->icon('heroicon-o-user-plus')
                    ->modalHeading('Add New Patient Profile')
                    ->modalWidth('6xl')
                    ->modalSubmitActionLabel('Save Patient Profile')
                    ->createAnother(false)
                    ->schema(fn ($form) => ProfileForm::configure($form)),
            ]);
    }
}