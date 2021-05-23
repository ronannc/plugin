<?php

namespace Ronan\plugin\Services;


use Ronan\plugin\Repositories\Contracts\ConfigRepository;

class ConfigService
{
    protected $repository;
    protected $utilsService;

    /**
     * syndicateService constructor.
     * @param ConfigRepository $repository
     */
    public function __construct( ConfigRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Função responsavel por tentar criar uma configuração
     *
     * @param array $data
     * @return array|\Illuminate\Database\Eloquent\Model
     */
    public function store( array $data )
    {
        try {
            return $this->repository->save( $data );
        } catch ( \Exception $exception ) {
            return [
                'error'   => true,
                'message' => $exception->getMessage()
            ];
        }
    }

    /**
     * Função responsavel por tentar atualizar uma configuração de id passado
     * @param array $data
     * @param $id
     * @return array|\Illuminate\Database\Eloquent\Model
     */
    public function update( array $data, $id )
    {
        try {
            return $this->repository->update( $this->repository->findOne( $id ), $data );
        } catch ( \Exception $exception ) {
            return [
                'error'   => true,
                'message' => $exception->getMessage()
            ];
        }
    }

    /**
     * Funçao responsavel por tentar recuperar uma configuração com o id passado
     *
     * @param $id
     * @return array|\Illuminate\Database\Eloquent\Model|null
     */
    public function findOne( $id )
    {
        try {
            return $this->repository->findOne( $id );
        } catch ( \Exception $exception ) {
            return [
                'error'   => true,
                'message' => $exception->getMessage()
            ];
        }
    }

    /**
     * @param $id
     * @return array|null
     */
    public function destroy($id): ?array
    {
        try {
            $config = $this->repository->findOneOrFail( $id );
            $this->repository->delete( $config );
            return NULL;
        } catch ( \Exception $exception ) {
            return [
                'error'   => true,
                'message' => $exception->getMessage()
            ];
        }
    }

    /**
     * Função responsavel por tentar recuperar as configurações
     *
     * @return array|mixed
     */
    public function getConfigs()
    {
        try {
            return $this->repository->getConfigs();
        } catch ( \Exception $exception ) {
            return [
                'error'   => true,
                'message' => $exception->getMessage()
            ];
        }
    }
}
