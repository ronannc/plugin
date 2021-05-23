<?php

namespace Ronan\plugin\Repositories\Contracts;


interface ConfigRepository extends BaseRepository
{
    /**
     * Função responsavel por retornar todas as configurações
     * @return mixed
     */
    public function getConfigs();
}
