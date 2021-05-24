<?php

namespace ronannc\plugin\Services;


use Illuminate\Support\Facades\Http;

class PlotsSaleService
{
    protected $configService;

    /**
     * PlotsSaleService constructor.
     *
     * @param ConfigService $configService
     */
    public function __construct( ConfigService $configService)
    {
        $this->configService = $configService;
    }

    /**
     * Requisição http na rota /vendas
     *
     * Headers [Client-Code, Client-Key, Content-Type -> application/Json] recuperados do banco de dados (sempre primeira posição)
     * Params [nu_referencia dfault(REF0001), nu_venda default(38425-uGet3-2KFMj), page default(0), per_page default(10), dt_venda default(2020-04-14), ]

     *
     * @param $params
     * @return array|mixed
     */
    public function getPlotsSale($params)
    {
        try {
            //recuperando as credenciais de acesso (client_code, client_key)
            $config = $this->configService->findOne($params['header'] ?? 1);

            //requisição http /parcelas
            return Http::withHeaders([
                'Content-Type' => 'application/json',
                'Client-Code' => $config->client_code,
                'Client-key' => $config->client_key,
            ])->get('https://api-sandbox.fpay.me/vendas', [
                'nu_referencia' => $params['nu_referencia'] ?? null,
                'nu_venda' => $params['nu_venda'] ?? null,
                'page' => $params['page'] ?? null,
                'per_page' => $params['per_page'] ?? null,
                'dt_venda' => $params['dt_venda'] ?? null,
            ])->json();
        } catch ( \Exception $exception ) {
            return [
                'error'   => true,
                'message' => $exception->getMessage()
            ];
        }
    }
}
