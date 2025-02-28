<?php

declare(strict_types=1);

namespace App\Forms\Schemas;

use App\Enums\AcceptedFileTypes;
use App\Models\Category;
use App\Models\Recipient;
use Filament\Forms\Components;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class NotificationFormSchema
{
    public static function get(): array
    {
        return [
            Components\Grid::make(['md' => 12])
                ->schema([
                    Components\Grid::make(1)
                        ->columnSpan(7)
                        ->schema([
                            Components\TextInput::make('title')
                                ->label('Título')
                                ->required()
                                ->maxLength(60)
                                ->dehydrateStateUsing(fn (string $state): string => Str::of($state)->lower()->ucfirst()->trim()->value())
                                ->placeholder('Digite o título da notificação'),

                            Components\RichEditor::make('content')
                                ->label('Conteúdo')
                                ->required()
                                ->maxLength(3000)
                                ->toolbarButtons([
                                    'bold',
                                    'italic',
                                    'underline',
                                    'link',
                                    'bulletList',
                                    'orderedList',
                                    'redo',
                                    'undo',
                                ])
                                ->hint(fn (Components\RichEditor $component): string => 'Máximo de caracteres: '.$component->getMaxLength())
                                ->placeholder('Escreva o conteúdo da notificação'),

                            Components\FileUpload::make('attachments')
                                ->label('Anexos')
                                ->multiple()
                                ->maxSize(8192) // 8MB
                                ->maxFiles(5)
                                ->previewable(false)
                                ->directory('notification-attachments')
                                ->acceptedFileTypes(AcceptedFileTypes::keys())
                                ->hint(fn (Components\FileUpload $component): string => 'Tamanho máximo: '.Number::fileSize($component->getMaxSize() * 1024))
                                ->helperText('Arquivos aceitos: Imagem, PDF, Excel, Word, PowerPoint'),
                        ]),

                    Components\Grid::make(1)
                        ->columnSpan(5)
                        ->schema([
                            Components\Select::make('recipient_ids')
                                ->label('Destinatários')
                                ->required(fn (Get $get): bool => ! $get('all_recipients'))
                                ->multiple()
                                ->options(Recipient::orderBy('id')->pluck('name', 'id'))
                                ->optionsLimit(fn (Components\Select $component) => count($component->getOptions()))
                                ->disabled(fn (Get $get): bool => $get('all_recipients')),

                            Components\Select::make('category_id')
                                ->label('Categoria')
                                ->required()
                                ->native(false)
                                ->options(Category::pluck('name', 'id')),

                            Components\Fieldset::make('settings')
                                ->label('Configurações')
                                ->columns(1)
                                ->schema([
                                    Components\Checkbox::make('all_recipients')
                                        ->label('Enviar para todos')
                                        ->reactive()
                                        ->helperText('Selecionar todos os destinatários automaticamente')
                                        ->afterStateUpdated(function (Set $set): void {
                                            $set('recipient_ids', []);
                                        }),

                                    Components\Checkbox::make('schedule_send')
                                        ->label('Programar envio')
                                        ->helperText('Definir data para o envio da notificação')
                                        ->reactive()
                                        ->afterStateUpdated(fn (Set $set) => $set('scheduled_at', null)),

                                    Components\DatePicker::make('scheduled_at')
                                        ->label('Data de envio')
                                        ->required()
                                        ->minDate(today())
                                        ->visible(fn (Get $get): bool => $get('schedule_send'))
                                        ->helperText('Notificação aparecerá a partir da data selecionada'),

                                    Components\Checkbox::make('recurrent_send')
                                        ->label('Notificação recorrente')
                                        ->helperText('Configure notificações para serem enviadas automaticamente em intervalos regulares')
                                        ->reactive()
                                        ->afterStateUpdated(function (Components\Component $component): void {
                                            $recurrenceComponent = $component->getContainer()
                                                ->getComponent('recurrence');

                                            if ($recurrenceComponent?->isVisible()) {
                                                $recurrenceComponent->getChildComponentContainer()->fill();
                                            }
                                        }),

                                    Components\Grid::make()
                                        ->key('recurrence')
                                        ->statePath('recurrence')
                                        ->schema([
                                            Components\Radio::make('interval')
                                                ->label('Intervalo')
                                                ->required()
                                                ->reactive()
                                                ->columns(3)
                                                ->options([
                                                    'daily' => 'Diário',
                                                    'weekly' => 'Semanal',
                                                    'monthly' => 'Mensal',
                                                ])
                                                ->columnSpanFull()
                                                ->afterStateUpdated(function (Set $set): void {
                                                    $set('interval_days_of_week', []);
                                                    $set('interval_day', null);
                                                }),

                                            Components\CheckboxList::make('interval_days_of_week')
                                                ->label('Selecione os dias da semana para envio')
                                                ->required()
                                                ->columns(2)
                                                ->options([
                                                    'monday' => 'Segunda',
                                                    'tuesday' => 'Terça',
                                                    'wednesday' => 'Quarta',
                                                    'thursday' => 'Quinta',
                                                    'friday' => 'Sexta',
                                                    'saturday' => 'Sabado',
                                                    'sunday' => 'Domingo',
                                                ])
                                                ->columnSpanFull()
                                                ->visible(fn (Get $get): bool => $get('interval') === 'weekly'),

                                            Components\Select::make('interval_day')
                                                    ->label('Selecione o dias para envio')
                                                    ->required()
                                                    ->options(range(1, 31))
                                                    ->columnSpanFull()
                                                    ->prefixIcon('lucide-calendar')
                                                    ->visible(fn (Get $get): bool => $get('interval') === 'monthly'),

                                            Components\DatePicker::make('start_date')
                                                ->label('Início da recorrência')
                                                ->required()
                                                ->minDate(today())
                                                ->prefixIcon('lucide-calendar-range')
                                                ->closeOnDateSelection(),

                                            Components\DatePicker::make('end_date')
                                                ->label('Término da recorrência')
                                                ->required()
                                                ->minDate(function (Get $get) {
                                                    $interval = $get('interval');

                                                    if ($interval === 'monthly') {
                                                        return today()->addMonths(1);
                                                    }

                                                    if ($interval === 'weekly') {
                                                        return today()->addWeeks(1);
                                                    }

                                                    return today();
                                                })
                                                ->prefixIcon('lucide-calendar-range')
                                                ->closeOnDateSelection(),

                                            Components\TimePicker::make('shipping_hour')
                                                ->label('Hora de envio')
                                                ->seconds(false)
                                                ->prefixIcon('lucide-clock')
                                                ->columnSpanFull(),

                                        ])
                                        ->visible(fn (Get $get): bool => $get('recurrent_send')),
                                ]),
                        ]),
                ]),
        ];
    }
}
