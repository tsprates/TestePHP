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
            <div class="text-right">
                <a href="/list" class="text-muted">Lista de contatos</a>
            </div>
            
            <div class="pt-2 pb-5 text-center">
                <h2>Teste <i class="fab fa-php fa-2x"></i></h2>
                <p>Resolução do teste proposto.</p>
            </div>
            
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            @if(Session::has('status'))
                <div class="alert alert-success"><i class="fas fa-check"></i> {{ Session::get('status') }}</div>
            @endif
            
            <form id="contact" method="post" action="/store" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <div class="form-group mb-3 row">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ old('name') }}">
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="" value="{{ old('email') }}">
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label for="phone">Telefone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="" value="{{ old('phone') }}">
                    </div>
    
                    <div class="form-group mb-3 row">
                        <label for="message">Mensagem:</label>
                        <textarea class="form-control" id="message" name="message" rows="4">{{ old('message') }}</textarea>
                    </div>
                    
                    <div class="form-group row">
                        <label for="attachment">Arquivo anexo:</label>
                        <input type="file" class="form-control-file" id="attachment" name="attachment" />
                    </div>
    
                    <div class="form-group py-3 row">
                        <button type="submit" class="btn btn-primary btn-lg btn-block mb-2"><i class="fas fa-check"></i> Cadastrar</button>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
    <style type="text/css">
    @keyframes spinner {
        to {transform: rotate(360deg);}
    }
    .fa-spinner { animation: spinner 1.2s linear infinite; }
    </style>
    <script>
        $(document).ready(function () {
            $.validator.addMethod("validphone", function (value, element, param) {
                return this.optional(element) || (/^\(\d{2}\) \d{5}-\d{4}$/).test(value);
            });

            $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || element.files[0].size <= param;
            });
            
            $.validator.addMethod('extension', function (value, element, param) {
                return this.optional(element) || !(/^(pdf|docx?|odt|txt)$/i).test(value);
            });

            $('#phone').mask('(00) 00000-0000');
            
            $("#contact").validate({
                rules: {
                    name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    phone:  {
                        validphone: true,
                        required: true
                    },
                    message: "required",
                    attachment: {
                        required: true,
                        filesize: 500000,
                        extension: true
                    }
                },
                messages: {
                    name:"O campo nome é obrigatório.",
                    email:{
                        required: "O campo e-mail é obrigatório.",
                        email: "O campo e-mail é inválido."
                    },
                    phone: {
                        validphone: "O campo telefone não é válido.",
                        required: "O campo telefone é obrigatório."
                    },
                    message: "O campo mensagem é obrigatório.",
                    attachment: {
                        required: "O campo anexo é obrigatório.",
                        filesize: "O arquivo anexo é maior que 500kb.",
                        extension: "O arquivo anexo é deve possuir a extensão: pdf, doc, docx, odt ou txt."
                    }
                },
                errorElement: "em",
                errorPlacement: function (error, element) {
                    error.addClass("text-danger");
                    if (element.prop("type") === "file") {
                        element.addClass("text-danger");
                    } else {
                        element.addClass("text-danger border border-danger");
                    }
                    error.insertAfter(element);
                },
                success: function (label, element) {
                    $(element).removeClass("text-danger border border-danger");
                },
                submitHandler: function(form) {
                    $('button[type="submit"]')
                        .addClass('btn-disabled')
                        .attr('disabled', 'disabled')
                        .html('<i class="fas fa-spinner"></i> Enviando...');
                    
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>