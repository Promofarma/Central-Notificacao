<?php

declare(strict_types=1);

namespace App\Livewire\Ui\Toast;

use Filament\Notifications\Notification;

final class ToastBuilder
{
    public function __construct(
        protected ?Notification $notification = null,
        protected ?string $title = null,
        protected ?string $body = null,
        protected ?string $icon = null,
    ) {
        $this->notification = $notification ?? new Notification(uniqid());
    }

    public static function create(?string $title = null): self
    {
        return app(self::class, [
            'title' => $title,
        ]);
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function title(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function body(?string $body = null): self
    {
        $this->body = $body;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function icon(string $icon): self
    {
        $this->icon = sprintf('%s-%s', self::getIconPackageName(), strtolower($icon));

        return $this;
    }

    public function build(): Notification
    {
        return $this->notification
            ->title($this->getTitle())
            ->body($this->getBody())
            ->icon($this->getIcon());
    }

    private static function getIconPackageName(): string
    {
        return 'heroicon-m';
    }
}
