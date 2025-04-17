<?php declare(strict_types=1);

namespace App\Livewire\Notification\Drawer;

use App\FormSchema\Contracts\FormSchemaContract;
use App\FormSchema\NotificationFormSchema;
use App\Livewire\Ui\Drawer\DrawerForm;
use App\Models\Notification;
use Filament\Forms\Form;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Locked;

/**
 * @property Form $form
 */
final class Edit extends DrawerForm
{
    #[Locked]
    public ?Notification $notification = null;

    public function getModel(): Model
    {
        return new Notification;
    }

    protected function getOperation(): string
    {
        return 'edit';
    }

    public function render(): Factory|View
    {
        return view('livewire.notification.drawer.edit');
    }
}
