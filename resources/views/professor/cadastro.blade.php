@extends("layouts.master")
@section("conteudo")  
<div class="animated fadeIn">
    <div class="">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Cadastro de Professores</strong>
                </div>
                <div class="card-body">
                    <!-- Credit Card -->
                    <div id="pay-invoice">
                        <div class="card-body">
                            <form id="formulario" action="/professor/salvar" method="post" novalidate="novalidate">
                                <input type="hidden" name="_token" value ="{{csrf_token()}}" />
                                <input type="hidden"  value="{{$professor->idProfessor}}" class="form-control-file" name="idProfessor">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="nome" class="control-label mb-1">Nome:</label>
                                            <input value="{{$professor->nome}}" id="nome" name="nome" type="text" class="form-control required" placeholder="Nome do Professor">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="telefone" class="control-label mb-1">Telefone:</label>
                                            <input value="{{$professor->telefone}}" id="telefone" name="telefone" type="text" class="form-control required" placeholder="(00) 0000-00000">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group has-success">
                                            <label for="email" class="control-label mb-1">E-mail:</label>
                                            <input value="{{$professor->email}}" id="email" name="email" type="email" class="form-control required valid" autocomplete="on" aria-required="true" placeholder="E-mail do professor">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="areaInteresse" class="control-label mb-1">Área de Interesse:</label>
                                            <select style="font-size: 1.8em" name="areaInteresse[]" id="areaInteresse" data-placeholder="Selecione as áreas de interesse" multiple class="standardSelect form-control required">
                                                <option value=""></option>
                                                @foreach ($areaInteresse as $row)
                                                @if($row->idAreaInteresse == $professor->idAreaInteresse)
                                                <option value="{{$row->idAreaInteresse}}" selected="selected">{{$row->nomeArea}}</option>
                                                @else
                                                <option value="{{$row->idAreaInteresse}}">{{$row->nomeArea}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="formacao" class="control-label mb-1">Formação Acadêmica:</label>
                                            <input value="{{$professor->formacaoAcademica}}" id="formacao" name="formacaoAcademica" type="text" class="form-control required" placeholder="Formação Acadêmica">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group has-success">
                                            <label for="lattes" class="control-label mb-1">Link Lattes:</label>
                                            <input value="{{$professor->lattes}}" id="lattes" name="lattes" type="url" class="form-control valid" autocomplete="on" aria-required="true" placeholder="Link do Lattes">
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
        $("#rg").mask("99.999.999-9");
        $("#cpf").mask("999.999.999-99");
        $('#telefone').mask("(9?9) 9999-99999").ready(function (event) {
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
    });
    jQuery(document).ready(function () {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });
</script>


@stop