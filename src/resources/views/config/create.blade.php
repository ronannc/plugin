@include('plugin::layout.head')
@include('plugin::layout.nav')
<div style="width: 500px; margin: 0 auto; margin-top: 90px;">
    @include('plugin::layout.flash-messages')
    <h3>Configurações (Header)</h3>
    <form action="{{route('config.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="client_code">Client-Code</label>
            <input type="text" class="form-control" name="client_code" id="client_code" placeholder="Client-Code">
        </div>
        <div class="form-group">
            <label for="client_key">Client-Key</label>
            <input type="text" class="form-control" name="client_key" id="client_key" placeholder="Client-Key">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@include('plugin::layout.footer')


