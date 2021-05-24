<?php

use Illuminate\Support\Facades\Route;
use ronannc\plugin\Http\Controllers\ClientControllers;
use ronannc\plugin\Http\Controllers\PlotsSaleControllers;
use ronannc\plugin\Http\Controllers\ConfigControllers;

/**
 * Rotas web do plugin
 */
Route::group(['middleware' => ['web']], function() {

    /**
     * Rota de listagem de clientes
     */
    Route::get( 'client', [ClientControllers::class, 'index'] )->name('client.index');

    /**
     * Rota de listagem de parcelas de venda
     */
    Route::get( 'plots-sale', [PlotsSaleControllers::class, 'index'] )->name('plots-sale.index');

    /**
     * Rotas para edição e listagem de configurações
     */
    Route::resource( 'config', ConfigControllers::class )->except([
        'show'
    ]);
});
