@extends("layouts.master")
@section("conteudo") 

<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tabela').DataTable({
            "pagingType": "full_numbers",
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
    });
</script>

<div class="animated fadeIn">
    <div class="">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Listagem de Formalizações</strong>
                </div>
                <div class="card-body">
                    <div id="pay-invoice">
                        <div class="card-body">
                            <div class="row">
                                @if (isset($enviarDoc))
                                <div class="col-sm-12">
                                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                        <span class="badge badge-pill badge-success">Sucesso</span> A apêndice B foi encaminhanda ao e-mail do aluno!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                @else

                                @endif
                            </div>
                            <div class="row">
                                <table id="tabela" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th>Aluno</th>
                                            <th>Orientador</th>
                                            <th>Documentação</th>
                                            <th>Editar</th>
                                            <th>Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($formalizacao as $row)
                                        <tr style="<?php if ($row->finalizado == 1){echo 'background-color:#DFF0D8';}if ($row->cancelada == 1){echo 'background-color:#F2DEDE';}?>">
                                            <td>
                                                {{ $row->titulo }}  
                                                <?php if ($row->finalizado == 1){echo '<span class=\'badge badge-success\'>Finalizada</span>';}if ($row->cancelada == 1){echo '<span class=\'badge badge-danger\'>Cancelada</span>';}?>
                                            </td>
                                            <td>{{ $row->nomeAluno }}</td>
                                            <td>{{ $row->nomeProfessor }}</td>
                                            <td>
                                                @if(empty($row->anexoB))
                                                <a href="/formalizacao/enviardoc?id={{$row->idFormalizacao }}">
                                                    <div class="btn btn-sm btn-outline-info">
                                                        <i class="fa fa-mail-forward"></i>
                                                        Enviar
                                                    </div>
                                                </a>
                                                @else
                                                <!--<img height="50px" src="http://localhost/sistematcc/storage/app/anexob/{{$row->anexoB}}">-->
                                                <!--<img height="50px" src="{{asset('/storage/app/anexob/'.$row->anexoB)}}">-->
                                                <a download target='_blank' href="http://localhost/sistematcc/storage/app/anexob/{{$row->anexoB}}">
                                                    <div class="btn btn-sm btn-outline-success">
                                                        <i class="fa fa-mail-forward"></i>
                                                        Ver
                                                    </div>
                                                </a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="/formalizacao?id={{$row->idFormalizacao }}">
                                                    <div class="btn btn-sm btn-outline-primary">
                                                        <i class="fa-pencil-square-o fa"></i>
                                                        Editar
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <a onclick="return confirm('Deseja realmente excluir?');" href="/formalizacao/excluir?idFormalizacao={{ $row->idFormalizacao }}">
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

@stop