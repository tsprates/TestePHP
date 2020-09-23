@component('mail::message')
<h4>Contato</h4>
<hr />
<div>
<strong>Nome</strong>: {{ $name }}
</div>
<div>
<strong>Email</strong>: {{ $email }}
</div>
<div>
<strong>Telefone</strong>: {{ $phone }}
</div>
<div>
<strong>Messagem</strong>: {{ $message }}
</div>
<div>
<strong>IP</strong>: {{ $ip }}
</div>
@component('mail::button', ['url' => asset($attachment)])
Anexo
@endcomponent
@endcomponent