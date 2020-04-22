@extends("layouts.master")
@section("conteudo")  

<div class="animated fadeIn">
    <div class="">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Cadastro de Marcações de Bancas</strong>
                    <a href="marcacao/listar">
                        <div class="box_right pointer" >
                            <span class="btn-info pointer">Listar</span> 
                        </div>
                    </a>
                </div>
                <div class="card-body">
                    <div id="pay-invoice">
                        <div class="card-body">
                            <form id="formulario" enctype="multipart/form-data" method="post" novalidate="novalidate" action="/marcacao/salvar" >
                                <input type="hidden" name="_token" value ="{{csrf_token()}}" />
                                <input type="hidden"  value="{{$marcacao->idMarcacao}}" class="form-control-file" name="idMarcacao">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label for="formalizacao" class="control-label mb-1">Formalização:</label>
                                            <select name="formalizacao" id="formalizacao" class="standardSelect form-control required" data-placeholder="Selecione a formalização..." tabindex="1">
                                                <option value="0">Nenhum</option>
                                                @foreach ($formalizacao as $row)
                                                @if($row->idFormalizacao == $marcacao->idFormalizacao)
                                                <option value="{{$row->idFormalizacao}}" selected="selected">{{$row->formalizacao}}</option>
                                                @else
                                                <option value="{{$row->idFormalizacao}}">{{$row->formalizacao}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        @if (!empty($marcacao->idMarcacao))
                                        <div class="box_right" >
                                            <label for="cancelada" class="btn-danger">Desativar</label> 
                                            <input type="checkbox" <?php if ($marcacao->cancelada == 1) {echo "checked";} ?> id="cancelada" name="cancelada" value="1" class="form-check-input">
                                        </div>
                                        @endif
                                        <div class="form-group check_form" >
                                            <label for="enviarDoc" class="control-label text-right mb-1" >Enviar Documentaçao?</label>
                                            <input name="enviarDoc" id="enviarDoc" class="" type="checkbox"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="local" class="control-label mb-1">Local:</label>
                                            <select name="local" id="local" class="form-control required">
                                                <option value="0">Nenhum</option>
                                                @foreach ($local as $row)
                                                @if($row->idLocal == $marcacao->idLocal)
                                                <option value="{{$row->idLocal}}" selected="selected">{{$row->descricao}}</option>
                                                @else
                                                <option value="{{$row->idLocal}}">{{$row->descricao}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="data" class="control-label mb-1">Data:</label>
                                            <!--<input id="ano" maxlength="4"  name="ano" type="text" value="@if (empty($marcacao->ano)){{ date('Y') }}@else{{ $marcacao->ano }}@endif" class="form-control required " >-->
                                            <input id="data" name="data" type="date" value="{{ date('d/m/Y', strtotime( $marcacao->dataHora )) }}" class="form-control required " >
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="hora" class="control-label mb-1">Hora:</label>
                                            <input id="hora"  name="hora" type="time" value="{{ date('H:i', strtotime( $marcacao->dataHora )) }}" class="form-control required "  placeholder="19:00">
                                            <!--<input id="ano" style="cursor: not-allowed" disabled name="ano" type="text" value="@if (empty($formalizacao->ano)){{ date('Y') }}@else{{ $formalizacao->ano }}@endif" class="form-control required " >-->
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="avaliador" class="control-label mb-1">Avaliadores da banca: (Obs.: Não é necessário selecionar o orientador)</label>
                                            <select style="font-size: 1.8em" name="avaliador[]" id="avaliador" data-placeholder="Selecione os avaliadores" multiple class="selectProfs form-control required">
                                                <option value=""></option>
                                                @foreach ($professor as $row)
                                                <option value="{{$row->idProfessor}}" >{{$row->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="anexoc" class="control-label mb-1">Apêndice C (Termo de Responsabilidade de Autoria):</label>
                                            <input name="anexoc" id="anexoc" class="form-control form-control-file" type="file" accept="image/*,application/pdf,application/vnd.ms-excel"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="anexog" class="control-label mb-1">Anexo G (Relatório das Atividades Complementares):</label>
                                            <input name="anexog" id="anexog" class="form-control form-control-file" type="file" accept="image/*,application/pdf,application/vnd.ms-excel"/>
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
        jQuery(document).ready(function () {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
        });
    });
    jQuery(document).ready(function () {
        jQuery(".selectProfs").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });
</script>


@stop