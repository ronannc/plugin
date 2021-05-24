<?php


namespace ronannc\plugin\Repositories;

use ronannc\plugin\Models\Config;
use ronannc\plugin\Repositories\Contracts\ConfigRepository;

class EloquentConfigRepository extends AbstractEloquentRepository implements ConfigRepository
{
    public function getConfigs(){
        return Config::all();
    }
}
