<?php

declare(strict_types=1);

namespace App\Livewire\Notification;

use App\Actions\DeleteNotification;
use App\Livewire\Ui\Toast\Toast;
use App\Models\Notification;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Delete extends Component
{
    use AuthorizesRequests;

    #[Locked]
    public Notification $notification;

    public function delete(DeleteNotification $action): void
    {
        try {
            $this->authorize('delete', $this->notification);

            $action->handle($this->notification);

            $this->dispatch('notification-deleted');
        } catch (QueryException $exception) {
            Toast::exception($exception)->now();
        } catch (AuthorizationException) {
            Toast::warning(
                title: 'Ops!',
                body: 'Você não tem permissão para executar essa ação!'
            )->now();
        }

        Toast::success(
            title: 'Opa!',
            body: 'Notificação removida com sucesso!'
        )->now();
    }

    public function render(): Factory|View
    {
        return view('livewire.notification.delete');
    }
}
