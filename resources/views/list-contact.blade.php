<!doctype html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        
        <title>Teste PHP</title>
    </head>
    <body>
    <div class="container">
        <div class="col-md-12">
            <div>
                <a href="/" class="text-muted"><i class="fas fa-arrow-left"></i> Voltar</a>
            </div>         
            
            <div class="pt-2 pb-5 text-center">
                <h2>Teste <i class="fab fa-php fa-2x"></i></h2>
                <p>Resolução do teste proposto.</p>
            </div>

            @foreach($contacts as $contact)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="card-text">
                        <h3 class="text-uppercase text-monospace font-weight-bold">
                            {{ $contact->name }}
                        </h3>
                        <hr />
                        
                        <p>
                            <strong>Email</strong>: <span class="text-muted">{{ $contact->email }}</span>
                        </p>
                        
                        <p>
                            <strong>Telefone</strong>: <span class="text-muted">{{ $contact->phone }}</span>
                        </p>
                        
                        <p>
                            <strong>Messagem</strong>: <em class="text-muted font-italic">{{ $contact->message }}</em>
                        </p>
                    </div>
                    
                    <a href="{{ asset($contact->attachment) }}" class="btn btn-primary float-right"><i class="fas fa-paperclip"></i> Ver anexo</a>
                </div>
            </div>
            @endforeach
        </div>  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>