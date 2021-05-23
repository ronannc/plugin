<?php

namespace Ronan\plugin\Services;


use Illuminate\Support\Facades\Http;

class ClientService
{
    protected $configService;

    /**
     * ClientService constructor.
     *
     * @param ConfigService $configService
     */
    public function __construct( ConfigService $configService)
    {
        $this->configService = $configService;
    }

    /**
     * Requisição http na rota /clientes
     *
     * Headers [Client-Code, Client-Key, Content-Type -> application/Json] recuperados do banco de dados (sempre primeira posição)
     * Params [nu_cliente, nu_documento, ds_email, ds_cep, page (default 1), per_page default(15), dt_inicial default(2019-01-01), dt_final]

     *
     * @param $params
     * @return array|mixed
     */
    public function getClients($params)
    {
        try {
            //recuperando as credenciais de acesso (client_code, client_key)
            $config = $this->configService->findOne($params['header'] ?? 1);

            //requisição http /clientes
            return Http::withHeaders([
                'Content-Type' => 'application/json',
                'Client-Code' => $config->client_code,
                'Client-key' => $config->client_key,
            ])->get('https://api-sandbox.fpay.me/clientes', [
                'nu_cliente' => $params['nu_cliente'] ?? null,
                'nu_documento' => $params['nu_documento'] ?? null,
                'ds_email' => $params['ds_email'] ?? null,
                'ds_cep' => $params['ds_cep'] ?? null,
                'page' => $params['page'] ?? null,
                'per_page' => $params['per_page'] ?? null,
                'dt_inicial' => $params['dt_inicial'] ?? null,
                'dt_final' => $params['dt_final'] ?? null
            ])->json();
        } catch ( \Exception $exception ) {
            return [
                'error'   => true,
                'message' => $exception->getMessage()
            ];
        }
    }
}
