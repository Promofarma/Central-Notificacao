<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Livewire\Ui\Page\Page;
use App\Livewire\Ui\Toast\Toast;
use Filament\Forms\Components;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportRedirects\Redirector;

/**
 * @property Form $form
 */
class Login extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $layout = 'components.layouts.guest';

    protected static string $view = 'livewire.auth.login';

    protected static ?string $title = 'Acesse sua conta';

    protected const REDIRECT_TO_ROUTE = 'notification.index';

    public ?array $data = [];

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Components\TextInput::make('email')
                    ->label('E-mail')
                    ->required()
                    ->email()
                    ->placeholder('exemplo@promofarma.com.br')
                    ->maxLength(255),

                Components\TextInput::make('password')
                    ->label('Senha')
                    ->required()
                    ->password()
                    ->revealable()
                    ->placeholder('Insira sua senha'),

                Components\Checkbox::make('remember_me')
                    ->label('Continuar conectado'),
            ]);
    }

    public function mount(): void
    {
        parent::mount();

        $this->form->fill();
    }

    public function handleFormSubmit(Request $request): Redirector|RedirectResponse
    {
        if (! $this->attemptLogin($this->getCredentials(), $this->isRememberMe())) {
            Toast::error(
                body: 'E-mail ou senha inválidos. Verifique suas credenciais e tente novamente.'
            )->now();

            return back();
        }

        $request->session()->regenerate();

        return to_route(static::REDIRECT_TO_ROUTE);
    }

    protected function getCredentials(): array
    {
        return $this->form->getStateOnly(['email', 'password']);
    }

    protected function isRememberMe(): bool
    {
        return $this->form->getState()['remember_me'];
    }

    protected function attemptLogin(array $crendentials, bool $remember): bool
    {
        return Auth::attempt($crendentials, $remember);
    }
}
