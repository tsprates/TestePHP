@component('mail::message')
<h2>Teste PHP</h2>
<h4>Contato</h4>
<hr />
<h3>Contato:</h3>
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

@endcomponent