<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefsRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refs_rewards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("from_id");
            $table->integer("to_id");
            $table->integer("deposit_id");
            $table->integer("payment_id");
            $table->text('amount');
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
        Schema::dropIfExists('refs_rewards');
    }
}
