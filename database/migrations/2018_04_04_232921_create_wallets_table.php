<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id");
            $table->string("payeer")->unique()->nullable();
            $table->string("pm")->unique()->nullable();
            $table->string("eth")->unique()->nullable();
            $table->string("btc")->unique()->nullable();
            $table->string("adv")->unique()->nullable();
            $table->string("ltc")->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
