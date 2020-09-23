@component('mail::message')
<h2>Contato</h2>

__Nome__: {{ $name }}

__Email__: {{ $email }}

__Telefone__: {{ $phone }}

__Messagem__: {{ $message }}

__IP__: {{ $ip }}

@component('mail::button', ['url' => asset($attachment)])
Anexo
@endcomponent
@endcomponent