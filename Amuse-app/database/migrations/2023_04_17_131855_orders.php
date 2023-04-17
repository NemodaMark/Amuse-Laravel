<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('userId');
        $table->unsignedBigInteger('gameId');
        $table->timestamp('timestamp')->useCurrent();
        $table->timestamps();

        $table->foreign('userId')->references('id')->on('users');
        $table->foreign('gameId')->references('id')->on('games');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['gameId']);
        });
    
        Schema::dropIfExists('games');
    }
    
    
};
