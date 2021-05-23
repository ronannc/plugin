<?php

namespace Ronan\plugin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ronan\plugin\Services\ConfigService;

class ConfigControllers extends Controller
{
    protected $service;

    /**
     * ConfigControllers constructor.
     *
     * @param ConfigService $configService
     */
    public function __construct(ConfigService $configService)
    {
        $this->service = $configService;
    }

    /**
     * Função responsavel por listar as configurações
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Config\Response
     */
    public function index()
    {
        $data = $this->service->getConfigs();

        return view('plugin::config.index', compact('data'));
    }

    /**
     * Função responsavel por retornar a tela de cadastrar uma nova configuração
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('plugin::config.create');
    }

    /**
     * Função responsavel por chamar o serviço de cadastrar uma nova configuração
     *
     * @param Request $request
     * @return array|\Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request)
    {
        //chamando o serviço para tentar cadastrar uma nova configuração
        $result = $this->service->store($request->all());
        if (!empty($result['error'])) {
            session()->flash('error', $result['message']);
            return back();
        }

        //enviando mensagem de sucesso para a view
        session()->flash('success', 'Configurações cadastradas com sucesso!');
        return redirect(route('config.index'));
    }

    /**
     * Função responsavel para mostrar a tela de edição de configuração
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //recuperando a configuração pelo id passado
        $data = $this->service->findOne($id);
        return view('plugin::config.edit', compact('data'));
    }

    /**
     * Função responsavel por atualizar a configuração com id passado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validadando os dados da requisição
        $request->validate([
            'client_code' => 'required|max:255',
            'client_key' => 'required|max:255',
        ]);

        //tentando atualizar a configuração
        $result = $this->service->update($request->all(), $id);

        //verificando o retorno do serviço de atualização
        if (!empty($result['error'])) {
            session()->flash('error', $result['message']);
            return back();
        }

        //enviando mensagem de sucesso para a view
        session()->flash('success', 'Configurações atualizada com sucesso!');
        return redirect(route('config.index'));
    }

    /**
     * Deleta uma configuração
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resultFrom = $this->service->destroy( $id );

        if ( !empty( $resultFrom[ 'error' ] ) ) {
            session()->flash( 'error', $resultFrom[ 'message' ] );
            return back();
        }

        session()->flash( 'status', 'Configuração deletada com sucesso!' );
        return back();
    }
}
