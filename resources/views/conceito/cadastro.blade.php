@extends("layouts.master")
@section("conteudo")  

                <div class="animated fadeIn">
                    <div class="">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Cadastro de Conceito</strong>
                                </div>
                                <div class="card-body">
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <form id="formulario"  action="/conceito/salvar" method="post" novalidate="novalidate">
                                                <input type="hidden" name="_token" value ="{{csrf_token()}}" />
                                                <input type="hidden"  value="{{$conceito->idConceito}}" class="form-control-file" name="idConceito">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="min" class="control-label mb-1">Nota Mínima:</label>
                                                            <input value="{{$conceito->min}}" id="min" maxlength="5" name="min" type="text" class="form-control required" placeholder="00.0">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="max" class="control-label mb-1">Nota Maxima:</label>
                                                            <input value="{{$conceito->max}}" id="max" maxlength="5" name="max" type="text" class="form-control required" placeholder="00.0">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="descricao" class="control-label mb-1">Descrição da Classificação:</label>
                                                            <input id="descricao" name="descricao" type="text" class="form-control required" placeholder="Descrição">
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
//                $("#min,#max").mask("99.9");
                $("#rg").mask("99.999.999-9");
                $("#cpf").mask("999.999.999-99");
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
            });
        </script>

        
@stop