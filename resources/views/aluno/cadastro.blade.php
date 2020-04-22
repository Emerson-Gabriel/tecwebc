@extends("layouts.master")
@section("conteudo")  

<div class="animated fadeIn">
    <div class="">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Cadastro de Aluno</strong>
                    <a href="/aluno/listar">
                        <div class="box_right pointer" >
                            <span class="btn-info pointer">Listar</span> 
                        </div>
                    </a>
                </div>
                <div class="card-body">
                    <div id="pay-invoice">
                        <div class="card-body">
                            <form id="formulario" method="post" action="/aluno/salvar">
                                <input type="hidden"  value="{{$aluno->idAluno}}" class="form-control-file" name="idAluno">
                                <input type="hidden" name="_token" value ="{{csrf_token()}}" />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="nome" class="control-label mb-1">Nome:</label>
                                            <input value="{{$aluno->nome}}" id="nome" name="nome" type="text" class="form-control required" placeholder="Nome do aluno">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group has-success">
                                            <label for="email" class="control-label mb-1">E-mail:</label>
                                            <input value="{{$aluno->email}}" id="email" name="email" type="email" class="form-control required " autocomplete="on" aria-required="true" placeholder="E-mail do aluno">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="matricula" class="control-label mb-1">Nº Matrícula:</label>
                                            <input value="{{$aluno->matricula}}" id="matricula" name="matricula" type="text" class="form-control  required" placeholder="00000000000-0">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group has-success">
                                            <label for="telefone" class="control-label mb-1">Telefone:</label>
                                            <input value="{{$aluno->telefone}}" id="telefone" name="telefone" type="text" class="form-control required " autocomplete="on" aria-required="true" placeholder="(00) 0000-00000">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="sexo" class="control-label mb-1">Sexo:</label>
                                        <div class="form-check">
                                            <div class="radio">
                                                <label for="m" class="form-check-label ">
                                                    <input type="radio" id="m" name="sexo" value="m" <?php if ($aluno->sexo == 'm' || ($aluno->idAluno == null )){echo 'checked=""';}?> class="form-check-input">Masculino
                                                </label>
                                                <label for="f" class="form-check-label margin_left">
                                                    <input type="radio" id="f" name="sexo" value="f" <?php if ($aluno->sexo == 'f'){echo 'checked=""';}?> class="form-check-input">Feminino
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="areaInteresse" class="control-label mb-1">Área de Interesse:</label>
                                            <select name="areaInteresse" id="areaInteresse" data-placeholder="Selecione a área de interesse..." class="standardSelect" tabindex="1">
                                                <option value="0">Nenhum</option>
                                                @foreach ($areaInteresse as $row)
                                                @if($row->idAreaInteresse == $aluno->idAreaInteresse)
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
                                            <label for="rg" class="control-label mb-1">RG:</label>
                                            <input value="{{$aluno->rg}}" id="rg" name="rg" type="text" class="form-control" placeholder="00.000.000-0">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group has-success">
                                            <label for="cpf" class="control-label mb-1">CPF:</label>
                                            <input value="{{$aluno->cpf}}" id="cpf" name="cpf" type="text" class="form-control" autocomplete="on" aria-required="true" placeholder="000.000.000-00">
                                        </div>
                                    </div>
                                </div>
								
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="orgaoExpeditor" class="control-label mb-1">Orgão Expeditor:</label>
                                            <input value="{{$aluno->orgaoExpeditor}}" id="orgaoExpeditor" name="orgaoExpeditor" type="text" class="form-control" placeholder="Orgão Expeditor">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="curso" class="control-label mb-1">Curso:</label>
                                            <select name="curso" id="curso" class="form-control required">
                                                <option value="0">Nenhum</option>
                                                @foreach ($curso as $row)
                                                @if($row->idCurso == $aluno->idCurso)
                                                <option value="{{$row->idCurso}}" selected="selected">{{$row->nome}}</option>
                                                @else
                                                <option value="{{$row->idCurso}}">{{$row->nome}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <i class="fa fa-paper-plane-o fa-lg"></i>&nbsp;
                                        <span>Salvar</span>
                                    </button>
                                </div>
                                <div class="row no_row_xs">
                                    <div id="envio_sucesso" class="text-center">

                                    </div>
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
        $("#matricula").mask("99999999999-9");
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
                },
                curso: {
                    required: true,
                    valueNotEquals: "0"
                }
            },
            messages: {
                name: {
                    required: ""
                }
            }
//                    ,
//                    submitHandler: function (form) {
//                        var dados = $(form).serialize();
//                        $.ajax({
//                            type: "POST",
//                            url: "action.php",
//                            data: dados,
//                            beforeSend: function () {
//                                $('#envio_sucesso').show();
//                                $('#envio_sucesso').html("<div class='text-center margin_top_3x'><img alt='loading' src='img/loader.svg'></div>");
//                                $('html,body').animate({scrollTop: $('#envio_sucesso').offset().top - 100}, 700);
//                                $('#form_contato')[0].reset();
//                                $('#form_contato').hide();
//                            },
//                            success: function (data) {
//                                $('#envio_sucesso').addClass("envio_sucesso");
//                                $('#envio_sucesso').html("" + data + "");
//                            },
//                            error: function (request, status, error) {
//                                alert(request.responseText);
//                            }
//                        });
//                        return false;
//                    }
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