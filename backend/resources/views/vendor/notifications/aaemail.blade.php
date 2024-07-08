<x-mail::message>
    <img src="{{ $message->embed(public_path('img/logo3c.jpg')) }}" alt="Logo">

    # Verificação de Email

    Olá!

    Por favor, clique no botão abaixo para verificar seu endereço de e-mail:

    <x-mail::button :url="$verificationUrl" color="primary">
        Verificar Email
    </x-mail::button>

    Se você não solicitou esta verificação, pode ignorar este e-mail.

    Atenciosamente,
    {{ config('app.name') }}

    {{-- Subcopy --}}
    <x-slot name="subcopy">
        @lang(
            "Se você está tendo problemas para clicar no botão \":actionText\", copie e cole a URL abaixo\n".
            'em seu navegador web:',
            [
                'actionText' => 'Verificar Email',
            ]
        ) <span class="break-all">[{{ $verificationUrl }}]({{ $verificationUrl }})</span>
    </x-slot>
</x-mail::message>
