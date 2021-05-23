<?php


namespace Ronan\plugin\Repositories;

use Ronan\plugin\Models\Config;
use Ronan\plugin\Repositories\Contracts\ConfigRepository;

class EloquentConfigRepository extends AbstractEloquentRepository implements ConfigRepository
{
    public function getConfigs(){
        return Config::all();
    }
}
