<?php

declare(strict_types=1);

namespace App\Forms\Schemas;

use App\Enums\AcceptedFileTypes;
use App\Models\Category;
use App\Models\Recipient;
use Carbon\Carbon;
use Filament\Forms\Components;
use Filament\Forms\Components\Component;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class NotificationFormSchema
{
    public static function get(): array
    {
        return [
            Components\Grid::make(12)
                ->schema([
                    self::makeContent()->columnSpan([
                        'md' => 7,
                        '3xl' => 9,
                    ]),
                    self::makeAside()->columnSpan([
                        'md' => 5,
                        '3xl' => 3,
                    ]),
                ]),
        ];
    }

    private static function makeContent(): Component
    {
        return Components\Grid::make(1)
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
                    ->toolbarButtons(['bold', 'italic', 'underline', 'link', 'bulletList', 'orderedList', 'redo', 'undo'])
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
            ]);
    }

    private static function makeAside(): Component
    {
        return Components\Grid::make(1)
            ->schema([
                Components\Select::make('recipient_ids')
                    ->label('Destinatários')
                    ->required(fn (Get $get): bool => ! $get('send_to_all_recipients'))
                    ->multiple()
                    ->options(Recipient::orderBy('id')->pluck('name', 'id'))
                    ->optionsLimit(fn (Components\Select $component) => count($component->getOptions()))
                    ->disabled(fn (Get $get): bool => $get('send_to_all_recipients')),

                Components\Select::make('category_id')
                    ->label('Categoria')
                    ->required()
                    ->options(Category::pluck('name', 'id')),

                self::makeOptions(),
            ]);
    }

    private static function makeOptions(): Component
    {
        return Components\Fieldset::make('options')
            ->label('Opções')
            ->columns(1)
            ->schema([
                Components\Checkbox::make('send_to_all_recipients')
                    ->label('Enviar para todos os destinatários?')
                    ->reactive()
                    ->helperText('Marque esta opção para selecionar todos os destinatários automaticamente.')
                    ->afterStateUpdated(function (Set $set): void {
                        $set('recipient_ids', []);
                    }),

                Components\Checkbox::make('is_scheduled')
                    ->label('Programar envio?')
                    ->reactive()
                    ->helperText('Marque esta opção para agendar o envio da notificação para uma data e hora futuras.')
                    ->afterStateUpdated(function (bool $state, Set $set): void {
                        $state ? $set('is_recurrent', false) : null;

                        $set('scheduled_date', null);
                        $set('scheduled_time', null);
                    }),

                Components\Grid::make()
                    ->schema([
                        Components\DatePicker::make('scheduled_date')
                            ->label('Data de envio')
                            ->required()
                            ->minDate(today()->addDay())
                            ->seconds(false)
                            ->lazy(),

                        Components\TimePicker::make('scheduled_time')
                            ->label('Hora de envio')
                            ->seconds(false)
                            ->lazy(),

                        Components\Placeholder::make('scheduled_placeholder')
                            ->hiddenLabel()
                            ->columnSpanFull()
                            ->content(function (Get $get): HtmlString {
                                $scheduledDateTime = Carbon::parse($get('scheduled_date'));

                                if ($get('scheduled_time')) {
                                    $scheduledDateTime->setTimeFromTimeString($get('scheduled_time'));
                                }

                                return new HtmlString(sprintf(
                                    '<p class="text-xs font-medium text-gray-500 break-words">A notificação será enviada em %s, às %s.</p>',
                                    $scheduledDateTime->format('d/m/Y'),
                                    $scheduledDateTime->format('H:i'),
                                ));
                            })
                            ->visible(fn (Get $get): bool => $get('scheduled_date') != null),
                    ])
                    ->visible(fn (Get $get): bool => $get('is_scheduled')),

                Components\Checkbox::make('is_recurrent')
                    ->label('Repetir envio?')
                    ->reactive()
                    ->helperText('Marque esta opção para repetir o envio da notificação em intervalos regulares.')
                    ->afterStateUpdated(function (bool $state, Set $set, Component $component): void {
                        $state ? $set('is_scheduled', false) : null;

                        $recurrenceComponent = $component->getContainer()->getComponent('recurrence');

                        if ($recurrenceComponent?->isVisible()) {
                            $recurrenceComponent->getChildComponentContainer()->fill();
                        }
                    }),

                Components\Grid::make()
                    ->key('recurrence')
                    ->statePath('recurrence')
                    ->schema([
                        Components\Select::make('interval')
                            ->label('Frequência de envio')
                            ->required()
                            ->reactive()
                            ->options([
                                'daily' => 'Diariamente',
                                'weekly' => 'Semanalmente',
                                'monthly' => 'Mensalmente',
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
                            ->live()
                            ->visible(fn (Get $get): bool => $get('interval') === 'weekly'),

                        Components\Select::make('interval_day')
                            ->label('Selecione o dia para envio')
                            ->required()
                            ->native(true)
                            ->options(range(1, 31))
                            ->columnSpanFull()
                            ->prefixIcon('lucide-calendar')
                            ->live()
                            ->visible(fn (Get $get): bool => $get('interval') === 'monthly'),

                        Components\DatePicker::make('start_date')
                            ->label('Início da recorrência')
                            ->required()
                            ->minDate(today())
                            ->prefixIcon('lucide-calendar-range')
                            ->closeOnDateSelection()
                            ->disabled(fn (Get $get) => is_null($get('interval'))),

                        Components\DatePicker::make('end_date')
                            ->label('Término da recorrência')
                            ->required()
                            ->minDate(fn (): Carbon => today()->addMonth())
                            ->prefixIcon('lucide-calendar-range')
                            ->closeOnDateSelection()
                            ->disabled(fn (Get $get) => is_null($get('interval')) || is_null($get('start_date'))),

                        Components\TimePicker::make('scheduled_time')
                            ->label('Hora de envio')
                            ->seconds(false)
                            ->prefixIcon('lucide-clock')
                            ->columnSpanFull()
                            ->disabled(fn (Get $get) => is_null($get('interval'))),
                    ])
                    ->lazy()
                    ->visible(fn (Get $get): bool => $get('is_recurrent')),

                Components\Placeholder::make('recurrent_placeholder')
                        ->hiddenLabel()
                        ->content(function (Get $get): ?HtmlString {
                            $interval = $get('recurrence.interval');

                            $period = collect([$get('recurrence.start_date'), $get('recurrence.end_date')])
                                ->filter(fn (?string $date): bool => $date != null)
                                ->map(fn (string $date): string => Carbon::parse($date)->format('d/m/Y'))
                                ->implode(' a ');

                            $daysOfWeek = collect($get('recurrence.interval_days_of_week'))
                                ->map(fn (string $day) => __(ucfirst($day)));

                            $base = Str::of('A notificação será enviada ')
                                ->when($interval === 'daily', fn (Stringable $str): Stringable => $str->append('todos os dias'))
                                ->when($interval === 'weekly', fn (Stringable $str): Stringable => $str->append('semanalmente, na ')->append($daysOfWeek->implode(', ')))
                                ->when($interval === 'monthly', fn (Stringable $str): Stringable => $str->append('mensalmente, no dia '.$get('recurrence.interval_day').' de cada mês'))
                                ->append(', de '.$period)
                                ->when($get('recurrence.scheduled_time') ?? '00:00', fn (Stringable $str, string $time): Stringable => $str->append(' às '.$time));

                            return new HtmlString('<p class="text-xs font-medium text-gray-500 break-words">'.$base->value().'</p>');
                        })
                        ->visible(fn (Get $get): bool => $get('is_recurrent') && match ($get('recurrence.interval')) {
                            'daily' => ($get('recurrence.start_date') !== null && $get('recurrence.end_date') !== null),
                            'weekly' => ($get('recurrence.start_date') !== null && $get('recurrence.end_date') !== null && count($get('recurrence.interval_days_of_week')) > 0),
                            'monthly' => ($get('recurrence.start_date') !== null && $get('recurrence.end_date') !== null && $get('recurrence.interval_day') !== null),
                            default => false,
                        })
                        ->columnSpanFull(),
            ]);
    }
}
