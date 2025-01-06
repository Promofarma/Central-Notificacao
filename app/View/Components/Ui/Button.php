<?php

declare(strict_types=1);

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use League\Csv\InvalidArgument;

class Button extends Component
{
    public function __construct(
        public string $as = 'button',
        public ?string $type = 'button',
        public ?string $href = null,
        public bool $isTargetBlank = false,
        public string $size = 'medium',
        public string $color = 'primary',
        public string $shape = 'rounded',
        public ?string $icon = null,
        public string $iconPosition = 'before',
        public ?string $wireTarget = null,
        public bool $fullSize = false,
        public ?string $text = null,
    ) {
    }

    protected function getIconPackageName(): string
    {
        return 'lucide';
    }

    protected function getButtonAttributes(): array
    {
        return [
            'type' => $this->type,
            'wire:loading.attr' => $this->wireTarget ? 'disabled' : null,
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
            throw new InvalidArgument('Invalid tag: ' . $tag);
        }

        return array_filter($attributes[$tag]);
    }

    public function getIcon(): string
    {
        return 'lucide-' . $this->icon;
    }

    public function getIconSize(): string
    {
        return match ($this->size) {
            'small' => 'w-4 h-4',
            'large' => 'w-6 h-6',
            default => 'w-5 h-5',
        };
    }

    public function render(): View|Closure|string
    {
        return view('components.ui.button');
    }
}
