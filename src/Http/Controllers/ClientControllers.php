<?php

namespace ronannc\plugin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ronannc\plugin\Services\ClientService;
use ronannc\plugin\Services\ConfigService;

class ClientControllers extends Controller
{
    protected $service;
    protected $configService;

    /**
     * ClientControllers constructor.
     *
     * @param ClientService $service
     * @param ConfigService $configService
     */
    public function __construct(ClientService $service, ConfigService $configService)
    {
        $this->service = $service;
        $this->configService = $configService;
    }

    /**
     * Função responsavel por listar os clientes e campos de filtro
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        session()->flush();
        //recuperando configuração para selct na view
        $extraData = $this->configService->getConfigs();

        //recuperando filtros
        $params = $request->get('params');

        //chamada para o serviço fazer a requisição http com os parametros passados
        $data = $this->service->getClients($params);

        if(!$data['success']){
            $msg = '';
            foreach ($data['errors'] as $error){
                $msg .= $error['message'];
            }

            session()->flash('error', $msg);
        }

        //retornando dados para a view
        return view('plugin::client.index', compact('data', 'params', 'extraData'));
    }
}
