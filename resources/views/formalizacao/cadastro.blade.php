@extends("layouts.master")
@section("conteudo")  

<div class="animated fadeIn">
    <div class="">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Cadastro de Formalização</strong>
                    <a href="formalizacao/listar">
                        <div class="box_right pointer" >
                            <span class="btn-info pointer">Listar</span> 
                        </div>
                    </a>
                </div>
                <div class="card-body">
                    <div id="pay-invoice">
                        <div class="card-body">
                            <form id="formulario" enctype="multipart/form-data"  action="/formalizacao/salvar" method="post" novalidate="novalidate">
                                <input type="hidden" name="_token" value ="{{csrf_token()}}" />
                                @if (!empty($formalizacao->idFormalizacao))
                                <div class="box_right" >
                                    <label for="cancelada" class="btn-danger">Desativar</label> 
                                    <input type="checkbox" id="cancelada" name="cancelada" <?php if ($formalizacao->cancelada == 1) {echo "checked";} ?> value="1" class="form-check-input">
                                </div>
                                @endif
                                <input type="hidden"  value="{{$formalizacao->idFormalizacao}}" class="form-control-file" name="idFormalizacao">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="titulo" class="control-label mb-1">Título:</label>
                                            <input  value="{{$formalizacao->titulo}}" id="titulo" name="titulo" type="text" class="form-control required" placeholder="Título do trabalho">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="ano" class="control-label mb-1">Ano:</label>
                                            <input id="ano" maxlength="4"  name="ano" type="text" value="@if (empty($formalizacao->ano)){{ date('Y') }}@else{{ $formalizacao->ano }}@endif" class="form-control required " >
                                            <!--<input id="ano" style="cursor: not-allowed" disabled name="ano" type="text" value="@if (empty($formalizacao->ano)){{ date('Y') }}@else{{ $formalizacao->ano }}@endif" class="form-control required " >-->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="aluno" class="control-label mb-1">Aluno:</label>
                                            <select name="aluno" id="aluno" data-placeholder="Selecione o aluno..." class="standardSelect aluno" tabindex="1" >
                                                <option value="0">Nenhum</option>
                                                @foreach ($aluno as $row)
                                                @if($row->idAluno == $formalizacao->idAluno)
                                                <option value="{{$row->idAluno}}" selected="selected">{{$row->nome}}</option>
                                                @else
                                                <option value="{{$row->idAluno}}">{{$row->nome}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="tipo" class="control-label mb-1">Tipo de Trabalho:</label>
                                            <select name="tipo" id="tipo" class="form-control required">
                                                <option value="0">Nenhum</option>
                                                @foreach ($tipoTrabalho as $row)
                                                @if($row->idTipo== $formalizacao->idTipo)
                                                <option value="{{$row->idTipo}}" selected="selected">{{$row->nomeTipo}}</option>
                                                @else
                                                <option value="{{$row->idTipo}}">{{$row->nomeTipo}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group areaInteresse">
                                            <label for="areaInteresse" class="control-label mb-1">Área de Interesse:</label>
                                            <select style="cursor: not-allowed;" name="areaInteresse" id="areaInteresse" class="form-control  required ">
                                                <option value="0">Nenhum</option>
                                                @foreach ($areaInteresse as $row)
                                                @if($row->idAreaInteresse == $formalizacao->idAreaInteresse)
                                                <option value="{{$row->idAreaInteresse}}" selected="selected">{{$row->nomeArea}}</option>
                                                @else
                                                <option value="{{$row->idAreaInteresse}}">{{$row->nomeArea}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="professorOrientador" class="control-label mb-1">Professor Orientador:</label>
                                            <select  name="professorOrientador" id="professorOrientador" class="form-control required">
                                                <option value="0">Nenhum</option>
                                                @foreach ($professor as $row)
                                                @if($row->idProfessor == $formalizacao->idProfessorOrientador)
                                                <option value="{{$row->idProfessor}}" selected="selected">{{$row->nome}}</option>
                                                @else
                                                <option value="{{$row->idProfessor}}">{{$row->nome}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="professorCoorientador" class="control-label mb-1">Professor Coorientador:</label>
                                            <select style="font-size: 1.8em" name="professorCoorientador[]" id="professorCoorientador" data-placeholder="Selecione o coorientador, se caso houver" multiple class="standardSelect form-control required">
                                                <option value=""></option>
                                                @foreach ($professor as $row)
                                                @if($row->idProfessor == $formalizacao->professorCoorientador)
                                                <option value="{{$row->idProfessor}}" selected="selected">{{$row->nome}}</option>
                                                @else
                                                <option value="{{$row->idProfessor}}">{{$row->nome}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label for="anexob" class="control-label mb-1">Apêndice B (Formalização do TCC):</label>
                                            <input name="anexob" id="anexob" value="{{ $formalizacao->anexoB }}" class="form-control form-control-file" type="file" accept="image/*,application/pdf,application/vnd.ms-excel"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group check_form" >
                                            <label for="enviarDoc" class="control-label text-right mb-1" >Enviar Documentaçao?</label>
                                            <input name="enviarDoc" id="enviarDoc" class="" type="checkbox"/>
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
        $(".aluno").change(function () {
            var idAluno = $(this).val();
            if (idAluno != 0) {
                $.ajax({
                    type: "GET",
                    url: "/formalizacao/professor",
                    data: {idAluno: idAluno},
                    success: function (retorno) {
//                        alert(retorno.idAreaInteresse);
//                        retorno.nomeArea;
                        $(".areaInteresse select").val(retorno.idAreaInteresse);
                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    }
                });
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