@include('plugin::layout.head')
@include('plugin::layout.nav')
<div style="width: 800px; margin: 0 auto; margin-top: 90px;">

    @include('plugin::layout.flash-messages')
    <div class="container">

        <form action="{{route('client.index')}}" method="GET">
            <div class="row">
                <div class="col-3">
                    <label for="" class="form-label">Configuração (header)</label>
                    <select class="form-select" aria-label="Configuração (header)" name="params[header]">
                        @foreach($extraData as $config)
                            <option value="{{$config['id']}}" {{isset($params['header']) && $params['header'] == $config['id'] ? 'selected' : '' }}>{!! $config['client_code'] !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="nu_cliente" class="form-label">nu_cliente</label>
                    <input type="text" class="form-control" name="params[nu_cliente]" id="nu_cliente" value="{{$params['nu_cliente'] ?? ''}}">
                </div>
                <div class="col-3">
                    <label for="nu_documento" class="form-label">nu_documento</label>
                    <input type="text" class="form-control" name="params[nu_documento]" id="nu_documento" value="{{$params['nu_documento'] ?? ''}}">
                </div>
                <div class="col-3">
                    <label for="ds_email" class="form-label">ds_email</label>
                    <input type="email" class="form-control" name="params[ds_email]" id="ds_email" value="{{$params['ds_email'] ?? ''}}">
                </div>
                <div class="col-3">
                    <label for="ds_cep" class="form-label">ds_cep</label>
                    <input type="text" class="form-control" name="params[ds_cep]" id="ds_cep" value="{{$params['ds_cep'] ?? ''}}">
                </div>
                <div class="col-3">
                    <label for="page" class="form-label">page</label>
                    <input type="number" class="form-control" name="params[page]" id="page" value="{{$params['page'] ?? ''}}">
                </div>
                <div class="col-3">
                    <label for="per_page" class="form-label">per_page</label>
                    <input type="number" class="form-control" name="params[per_page]" id="per_page" value="{{$params['per_page'] ?? ''}}">
                </div>
                <div class="col-3">
                    <label for="dt_inicial" class="form-label">dt_inicial</label>
                    <input type="date" class="form-control" name="params[dt_inicial]" id="dt_inicial" value="{{$params['dt_inicial'] ?? ''}}">
                </div>
                <div class="col-3">
                    <label for="dt_final" class="form-label">dt_final</label>
                    <input type="date" class="form-control" name="params[dt_final]" id="dt_final" value="{{$params['nu_clientdt_finale'] ?? ''}}">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>
    </div>

    <h3>Clientes</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Documento</th>
            <th scope="col">Qtd. Vendas</th>
        </tr>
        </thead>
        <tbody>
        @if(!isset($data) || !$data['success'])
            <tr>
                <th colspan="3" style="text-align: center">Sem Dados</th>
            </tr>
        @else
            @foreach($data['data'] as $client)
                <tr>
                    <td>{{$client['nm_cliente']}}</td>
                    <td>{{$client['nu_documento']}}</td>
                    <td>{{$client['qtd_vendas']}}</td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>
@include('plugin::layout.footer')


