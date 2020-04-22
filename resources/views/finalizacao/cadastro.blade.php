@extends("layouts.master")
@section("conteudo")  

<div class="animated fadeIn">
    <div class="">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Cadastro de Finalizações</strong>
                    <a href="finalizacao/listar">
                        <div class="box_right pointer" >
                            <span class="btn-info pointer">Listar</span> 
                        </div>
                    </a>
                </div>
                <div class="card-body">
                    <div id="pay-invoice">
                        <div class="card-body">
                            <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
                                <span class="badge badge-pill badge-warning">Alerta!</span>
                                Após a finalização não será mais possivel a exclusão ou edição do TCC.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="formulario" enctype="multipart/form-data" method="post" novalidate="novalidate" action="/finalizacao/salvar" >
                                <input type="hidden" name="_token" value ="{{csrf_token()}}" />
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="idMarcacao" class="control-label mb-1">Marcação:</label>
                                            <select name="idMarcacao" id="idMarcacao" class="standardSelect form-control required" data-placeholder="Selecione a formalização..." tabindex="1">
                                                <option value="0">Nenhum</option>
                                                @foreach ($formalizacao as $row)
                                                <option value="{{$row->idMarcacao}}">{{$row->formalizacao}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="nota" class="control-label mb-1">Nota:</label>
                                            <input id="nota" name="nota" type="text" value="" placeholder="99.0" class="form-control required " >
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="tituloFinal" class="control-label mb-1">Título final:</label>
                                            <input id="tituloFinal" name="tituloFinal" type="text" value="" class="form-control required " >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="anexoi" class="control-label mb-1">Anexo I (Termo de Autorização Eletrônica):</label>
                                            <input name="anexoi" id="anexoi" class="form-control required form-control-file" type="file" accept="image/*,application/pdf,application/vnd.ms-excel"/>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <i class="fa fa-paper-plane-o fa-lg"></i>&nbsp;
                                        <span>Salvar</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $.validator.addMethod("valueNotEquals", function (value, element, arg) {
            return arg != element.value;
        }, "Opção inválida.");
        $("#nota").mask("99.9");
        $("#rg").mask("99.999.999-9");
        $("#cpf").mask("999.999.999-99");
        $('#cTelefone').mask("(9?9) 9999-99999").ready(function (event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = (/\D/g, '');//tirando todos caracteres
            element = $(target);
            element.unmask();
            if (phone.length > 10) {
                element.mask("(9?9) 99999-99999");
            } else {
                element.mask("(9?9) 9999-999999");
            }
        });
        $("#formulario").validate({
            errorClass: "is-invalid",
            validClass: "is-valid",
            errorPlacement: function (error, element) {
                error.appendTo(element.parent("td").next("td"));//retirando o label para erro
            },
            rules: {
                name: {
                    minlength: 3,
                    maxlength: 70
                }
            },
            messages: {
                name: {
                    required: ""
                }
            },
            submitHandler: function (form) {
                var dados = $(form).serialize();
                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: dados,
                    beforeSend: function () {
                        $('#envio_sucesso').show();
                        $('#envio_sucesso').html("<div class='text-center margin_top_3x'><img alt='loading' src='img/loader.svg'></div>");
                        $('html,body').animate({scrollTop: $('#envio_sucesso').offset().top - 100}, 700);
                        $('#form_contato')[0].reset();
                        $('#form_contato').hide();
                    },
                    success: function (data) {
                        $('#envio_sucesso').addClass("envio_sucesso");
                        $('#envio_sucesso').html("" + data + "");
                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    }
                });
                return false;
            }
        });
        jQuery(document).ready(function () {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
        });
    });
</script>


@stop