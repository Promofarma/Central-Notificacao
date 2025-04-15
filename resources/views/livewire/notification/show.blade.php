<x-ui.page
    :$title
    :$headerButtons
>
    <div class="grid colsgrid-cols-1 md:grid-cols-3">

        <div class="space-y-4 md:col-span-7 2xl:col-span-9">
            <x-ui.heading
                level="3"
                size="base"
            >Conteúdo</x-ui.heading>
            <div class="prose prose-gray max-w-none">
                {!! $notification->content !!}
            </div>
        </div>

        <div class="space-y-6 md:col-span-5 2xl:col-span-3">
            <dl class="space-y-4">
                <div class="space-y-1">
                    <dt>
                        <x-ui.text
                            variant="strong"
                            size="xs"
                        >Categoria:</x-ui.text>
                    </dt>
                    <dd>
                        <x-ui.badge>{{ $notification->category->name }}</x-ui.badge>
                    </dd>
                </div>

                <div class="space-y-1">
                    <dt>
                        <x-ui.text
                            variant="strong"
                            size="xs"
                        >Criado por:</x-ui.text>
                    </dt>
                    <dd>
                        <x-ui.text>{{ $notification->user->name }}</x-ui.text>
                    </dd>
                </div>

                <div class="space-y-1">
                    <dt>
                        <x-ui.text
                            variant="strong"
                            size="xs"
                        >Criado em:</x-ui.text>
                    </dt>
                    <dd>
                        <x-ui.text>{{ $notification->formatted_created_at }}</x-ui.text>
                    </dd>
                </div>

                <div class="space-y-1">
                    <dt>
                        <x-ui.text
                            variant="strong"
                            size="xs"
                        >Tipo de envio:</x-ui.text>
                    </dt>
                    <dd>
                        <x-ui.text>{{ $notification->send_type->label() }}</x-ui.text>
                    </dd>
                </div>

                <div class="space-y-1">
                    <dt>
                        <x-ui.text
                            variant="strong"
                            size="xs"
                        >Destinatários:</x-ui.text>
                    </dt>
                    <dd class="grid grid-cols-9 gap-2">
                        @foreach ($notification->recipients as $recipient)
                            <x-notification.recipient.item :$recipient />
                        @endforeach
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</x-ui.page>
