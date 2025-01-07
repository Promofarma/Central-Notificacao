<?php

declare(strict_types=1);

namespace App\Livewire\Ui\Toast;

use Filament\Notifications\Notification;

class ToastBuilder
{
    public function __construct(
        protected ?Notification $notification = null,
        protected ?string $title = null,
        protected ?string $body = null,
        protected ?string $icon = null,
    ) {
        $this->notification = $notification ?? new Notification(uniqid());
    }

    protected static function getIconPackageName(): string
    {
        return 'lucide';
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
        $this->icon = sprintf('%s-%s', static::getIconPackageName(), strtolower($icon));

        return $this;
    }

    public static function create(string $title = null): self
    {
        return app(static::class, [
            'title' => $title,
        ]);
    }

    public function build(): Notification
    {
        return $this->notification
            ->title($this->getTitle())
            ->body($this->getBody())
            ->icon($this->getIcon());
    }
}
