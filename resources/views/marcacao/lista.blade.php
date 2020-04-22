@extends("layouts.master")
@section("conteudo") 

<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<script>
    $('#tabela').DataTable({
        "pagingType": "simple",
        language: {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ Resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });
    

//        $('#enviaId').click(function () {
//            var chklista = $('input[name="itens"]:checked').toArray().map(function (check) {
//                return $(check).val();
//            });

//            var itensCheck;
//            var id = itensCheck + $(this).val();

//                    alert(chklista);
//        });
</script>

<div class="animated fadeIn">
    <div class="">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Listagem de Marcações</strong>
                    <a href="/marcacao/lista-completa">
                        <div class="box_right pointer" >
                            <span class="btn-info pointer">Listagem completa</span> 
                        </div>
                    </a>
                    <a id="enviaId" onclick="selecionarTodos()">
                        <div class="box_right pointer" >
                            <span style="border-radius: 7px;padding: 1px 5px" class="btn-dark pointer">Enviar para Marcados</span> 
                        </div>
                    </a>
                </div>
                <div class="card-body">
                    <div id="pay-invoice">
                        <div class="card-body">
                            <div class="row">
                                <table id="tabela" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>TCC</th>
                                            <th>Data/Hora</th>
                                            <th>Local</th>
                                            <th>Documentação</th>
                                            <th>Editar</th>
                                            <th>Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($marcacao as $row)
                                        <tr>
                                            <td><input class="itens " style="height: 20px;width: 20px   " value="{{$row->idMarcacao }}" type="checkbox" ></td>
                                            <td>{{ $row->tcc }} - {{ $row->nomeAluno }}</td>
                                            <td>{{ $row->dataHora }}</td>
                                            <td>{{ $row->descricao }}</td>
                                            <td>
                                                <a href="/marcacao/certificadoOrientador?idMarcacao={{$row->idMarcacao }}">
                                                    <div class="btn btn-sm  btn-outline-primary ">
                                                        <i class="mdi mdi-18px mdi-pencil-circle-outline"></i>
                                                        Certificado Orientador
                                                    </div>
                                                </a>
                                                <br/>
                                                <a href="/marcacao/certificadoAvaliadores?idMarcacao={{$row->idMarcacao }}">
                                                    <div class="btn btn-sm  btn-outline-secondary margin_top_1x">
                                                        <i class="mdi mdi-18px mdi-pencil-circle-outline"></i>
                                                        Certificados Avaliadores
                                                    </div>
                                                </a>
                                                <a href="/marcacao/geraata?idMarcacao={{$row->idMarcacao }}">
                                                    <div class="btn btn-sm btn-outline-dark margin_top_1x">
                                                        <i class="fa fa-mail-forward"></i>
                                                        ATA
                                                    </div>
                                                </a>
                                                @if(empty($row->anexoC))
                                                <a href="/marcacao/enviardoc?id={{$row->idMarcacao }}">
                                                    <div class="btn btn-sm btn-outline-info margin_top_1x">
                                                        <i class="fa fa-mail-forward"></i>
                                                        Enviar AC
                                                    </div>
                                                </a>
                                                @else
                                                <a download target='_blank' href="/marcacao/downloadC?arquivo={{$row->anexoC}}">
                                                    <div class="btn btn-sm btn-outline-success margin_top_1x">
                                                        <i class="fa fa-mail-forward"></i>
                                                        Ver AC
                                                    </div>
                                                </a>
                                                @endif
                                                @if(empty($row->anexoG))
                                                <a href="/marcacao/enviardoc?id={{$row->idMarcacao }}">
                                                    <div class="btn btn-sm btn-outline-info margin_top_1x">
                                                        <i class="fa fa-mail-forward"></i>
                                                        Enviar AG
                                                    </div>
                                                </a>
                                                @else
                                                <a download target='_blank' href="/marcacao/downloadG?arquivo={{$row->anexoG}}">
                                                    <div class="btn btn-sm btn-outline-success margin_top_1x">
                                                        <i class="fa fa-mail-forward"></i>
                                                        Ver AG
                                                    </div>
                                                </a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="/marcacao?idMarcacao={{$row->idMarcacao }}">
                                                    <div class="btn btn-sm btn-outline-primary">
                                                        <i class="fa-pencil-square-o fa"></i>
                                                        Editar
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <a onclick="return confirm('Deseja realmente excluir?');" href="/marcacao/excluir?idMarcacao={{ $row->idMarcacao }}">
                                                    <button type="button" class="btn btn-sm btn-outline-danger">
                                                        <i class="fa fa-times-circle-o"></i>
                                                        Excluir
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
function selecionarTodos() {
        var ids = "";
        $(".itens:checked").each(function () {
            ids += $(this).val() + ",";
        });
        ids = ids.slice(0, -1);
        var url = "http://localhost:8000/marcacao/geraatas?idMarcacao="+ids;
//        alert(url)
        window.location.href = url;
    }
</script>

@stop