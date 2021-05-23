@include('plugin::layout.head')
@include('plugin::layout.nav')
<div style="width: 800px; margin: 0 auto; margin-top: 90px;">
    @include('plugin::layout.flash-messages')

    <div class="modal fade" id="confirmDiolog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formDelete" action="" method="post">
                    {!! method_field('delete') !!}
                    {!! csrf_field() !!}
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Deseja realmente excluir ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Sim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <h3>Configurações (Header)</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Client-Code</th>
            <th scope="col">Client-Key</th>
            <th scope="col">Ação</th>
        </tr>
        </thead>
        <tbody>
        @if(!isset($data))
            <tr>
                <th colspan="4" style="text-align: center">Sem Dados</th>
            </tr>
        @else
            @foreach($data as $config)
            <tr>
                <th scope="row">{{$config['id']}}</th>
                <td>{{$config['client_code']}}</td>
                <td>{{$config['client_key']}}</td>
                <td><a class="btn btn-primary" href="{{route('config.edit', $config)}}" role="button">Editar</a><a class="btn btn-danger delete" data-id="{{$config['id']}}" role="button">Deletar</a></td>
            </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>

<script
    src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
    integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="
    crossorigin="anonymous"></script>
<script>
    $('.delete').click(function(){
        var id = $(this).data("id");
        $('#formDelete').attr('action', "config/"+id+"")
        $('#confirmDiolog').modal('show')
    });
</script>
@include('plugin::layout.footer')


