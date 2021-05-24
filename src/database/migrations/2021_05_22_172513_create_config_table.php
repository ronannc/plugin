<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->id();
            $table->string('client_code');
            $table->string('client_key');
            $table->timestamps();
        });

        \ronannc\pluguin\Models\Config::create(
            ['client_code' => 'FC-SB-15', 'client_key' => '6ea297bc5e294666f6738e1d48fa63d2']
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config');
    }
}
