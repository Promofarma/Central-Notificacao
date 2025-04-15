<?php

declare(strict_types=1);

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Button extends Component
{
    public function __construct(
        public string $as = 'button',
        public ?string $type = 'button',
        public ?string $href = null,
        public bool $isTargetBlank = false,
        public string $size = 'default',
        public string $color = 'primary',
        public string $shape = 'rounded',
        public ?string $icon = null,
        public string $iconPosition = 'before',
        public ?string $wireTarget = null,
        public bool $fullSize = false,
        public ?string $text = null,
        public ?string $formId = null,
        public array $alpineExtraAttributes = [],
        public ?string $id = null,
        public bool $visible = true,
    ) {}

    protected function getIconPackageName(): string
    {
        return 'heroicon-s';
    }

    protected function getButtonAttributes(): array
    {
        return [
            'type' => $this->type,
            'form' => $this->formId,
            'wire:loading.attr' => $this->wireTarget ? 'data-loading' : null,
            'wire:target' => $this->wireTarget,
        ];
    }

    protected function getAnchorAttributes(): array
    {
        return [
            'href' => $this->href,
            'target' => $this->isTargetBlank ? '_blank' : null,
            'rel' => $this->isTargetBlank ? 'noopener noreferrer' : null,
        ];
    }

    protected function getDefaultAttributes(): array
    {
        return [
            'id' => $this->id,
        ];
    }

    public function getTag(): string
    {
        return $this->href ? 'a' : $this->as;
    }

    public function getTagAttributes(): array
    {
        $attributes = [
            'a' => $this->getAnchorAttributes(),
            'button' => $this->getButtonAttributes(),
        ];

        $tag = $this->getTag();

        if (!array_key_exists($tag, $attributes)) {
            throw new \InvalidArgumentException('Invalid tag: ' . $tag);
        }

        return array_filter([
            ...$this->getDefaultAttributes(),
            ...$attributes[$tag],
            ...$this->alpineExtraAttributes
        ]);
    }

    public function getIcon(): string
    {
        return $this->getIconPackageName() . '-' . $this->icon;
    }

    public function getIconSize(): string
    {
        return match ($this->size) {
            'sm' => 'w-4 h-4',
            'lg' => 'w-6 h-6',
            default => 'w-5 h-5',
        };
    }

    public function render(): View|Closure|string|null
    {
        return $this->visible ? view('components.ui.button') : null;
    }
}
