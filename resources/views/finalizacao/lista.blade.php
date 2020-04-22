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
</script>

<div class="animated fadeIn">
    <div class="">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Listagem de Finalização</strong>
                </div>
                <div class="card-body">
                    <div id="pay-invoice">
                        <div class="card-body">
                            <div class="row">
                                <table id="tabela" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Titulo</th>
                                            <th>Data</th>
                                            <th>Nota</th>
                                            <th>Documentos</th>
                                            <th>Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($finalizacao as $row)
                                        <tr>
                                            <td>{{ $row->tituloFinal }}</td>
                                            <td>{{ date('d/m/Y', strtotime( $row->dataFinalizacao )) }}</td>
                                            <td>{{ number_format($row->nota, 1, '.', '')}}</td>
                                            <td>
                                                <a href="/finalizacao/ataCRCA?idMarcacao={{$row->idMarcacao }}">
                                                    <div class="btn btn-sm  btn-outline-success ">
                                                        <i class="mdi mdi-18px mdi-pencil-circle-outline"></i>
                                                        ATA CRCA
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <a onclick="return confirm('Deseja realmente excluir?');" href="/finalizacao/excluir?idMarcacao={{ $row->idMarcacao }}">
                                                    <div class="btn btn-sm  btn-outline-danger">
                                                        <i class="mdi mdi-18px mdi-close-circle-outline"></i>
                                                    </div>
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

@stop