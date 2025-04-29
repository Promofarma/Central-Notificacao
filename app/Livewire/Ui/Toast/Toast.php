<?php

declare(strict_types=1);

namespace App\Livewire\Ui\Toast;

use Throwable;

final class Toast
{
    public static function success(string $title = 'Sucesso! Ação concluída', string $icon = 'check', ?string $body = null): ToastSender
    {
        return self::make($title, $body, $icon);
    }

    public static function error(string $title = 'Ops! Algo deu errado', string $icon = 'alert-triangle', ?string $body = null): ToastSender
    {
        return self::make($title, $body, $icon);
    }

    public static function warning(string $title = 'Atenção! Verifique isso', string $icon = 'alert-triangle', ?string $body = null): ToastSender
    {
        return self::make($title, $body, $icon);
    }

    public static function info(string $title = 'Informação importante', string $icon = 'info', ?string $body = null): ToastSender
    {
        return self::make($title, $body, $icon);
    }

    public static function exception(Throwable $exception): ToastSender
    {
        logger($exception->getMessage(), [
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ]);

        return self::error(body: $exception->getMessage());
    }

    public static function make(string $title, ?string $body = null, ?string $icon = null): ToastSender
    {
        $toastBuilder = ToastBuilder::create()
            ->title($title)
            ->body($body)
            ->icon($icon)
            ->build();

        return new ToastSender($toastBuilder);
    }
}
