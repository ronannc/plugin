@include('plugin::layout.head')
@include('plugin::layout.nav')
<div style="width: 1000px; margin: 0 auto; margin-top: 90px;">
    @include('plugin::layout.flash-messages')

    <div class="container">

        <form action="{{route('plots-sale.index')}}" method="GET">
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
                    <label for="nu_referencia" class="form-label">nu_referencia</label>
                    <input type="text" class="form-control" name="params[nu_referencia]" id="nu_referencia"
                           value="{{$params['nu_referencia'] ?? ''}}">
                </div>
                <div class="col-3">
                    <label for="nu_venda" class="form-label">nu_venda</label>
                    <input type="text" class="form-control" name="params[nu_venda]" id="nu_venda"
                           value="{{$params['nu_venda'] ?? ''}}">
                </div>
                <div class="col-3">
                    <label for="page" class="form-label">page</label>
                    <input type="number" class="form-control" name="params[page]" id="page"
                           value="{{$params['page'] ?? ''}}">
                </div>
                <div class="col-3">
                    <label for="per_page" class="form-label">per_page</label>
                    <input type="number" class="form-control" name="params[per_page]" id="per_page"
                           value="{{$params['per_page'] ?? null}}">
                </div>
                <div class="col-3">
                    <label for="dt_venda" class="form-label">dt_venda</label>
                    <input type="date" class="form-control" name="params[dt_venda]" id="dt_venda"
                           value="{{$params['dt_venda'] ?? ''}}">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>


    </div>

    <h3>Vendas</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">N° Venda</th>
            <th scope="col">Cliente</th>
            <th scope="col">Documento</th>
            <th scope="col">Data Venda</th>
            <th scope="col">Valor Venda</th>
            <th scope="col">N° Parcelas</th>
            <th scope="col">Parcelas</th>
        </tr>
        </thead>
        <tbody>
        @if(!isset($data) || !$data['success'])
            <tr>
                <th colspan="7" style="text-align: center">Sem Dados</th>
            </tr>
        @else
            @php $count = 0 @endphp
            @foreach($data['data'] as $venda)
                <tr>
                    <td>{{$venda['nu_venda']}}</td>
                    <td>{{$venda['nm_cliente']}}</td>
                    <td>{{$venda['nu_documento']}}</td>
                    <td>{{$venda['dt_venda']}}</td>
                    <td>{{$venda['vl_venda']}}</td>
                    <td>{{$venda['nu_parcelas']}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal{{$count}}">
                            Parcelas
                        </button>
                    </td>
                </tr>
                @php $count = $count + 1 @endphp
            @endforeach
        @endif

        </tbody>
    </table>

    @if(!isset($data) && $data['success'])
        @php $count = 0 @endphp
        @foreach($data['data'] as $venda)
            <div class="modal fade" id="modal{{$count}}" tabindex="-1" aria-labelledby="modal{{$count}}" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal{{$count}}">Parcelas - {!! $venda['nu_venda'] !!}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Numero</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Situação</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Data Vencimento</th>
                                    <th scope="col">Data Pagamento</th>
                                    <th scope="col">Data Cobrança</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($venda['parcelas'] as $parcelas)
                                    <tr>
                                        <td>{{$parcelas['nu_parcela']}}</td>
                                        <td>{{$parcelas['vl_parcela']}}</td>
                                        <td>{{$parcelas['situacao']}}</td>
                                        <td>{{$parcelas['tipo']}}</td>
                                        <td>{{$parcelas['dt_vencimento']}}</td>
                                        <td>{{$parcelas['dt_pagamento']}}</td>
                                        <td>{{$parcelas['dt_cobranca']}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>                @php $count = $count + 1 @endphp

        @endforeach
    @endif
</div>
@include('plugin::layout.footer')


