
@extends("layouts.master")
@section("conteudo") 

<!--<script type="text/javascript" src="js/datatables.min.js"></script>-->
<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
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
                    <strong class="card-title">Listagem de Aluno</strong>
                    <a href="/aluno/">
                        <div class="box_right pointer" >
                            <span class="btn-info pointer">Novo</span> 
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
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Telefone</th>
                                            <th>RA</th>
                                            <th>Curso</th>
                                            <th>Editar</th>
                                            <th>Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($aluno as $row)
                                        <tr>
                                            <td>{{ $row->nome }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->telefone }}</td>
                                            <td>{{ $row->matricula }}</td>
                                            <td>{{ $row->nomeCurso }}</td>
                                            <td>
                                                <a href="/aluno?idAluno={{$row->idAluno }}">
                                                    <div class="btn btn-sm btn-outline-primary">
                                                        <i class="fa-pencil-square-o fa"></i>
                                                        Editar
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <a onclick="return confirm('Deseja realmente excluir?');" href="/aluno/excluir?idAluno={{ $row->idAluno }}">
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