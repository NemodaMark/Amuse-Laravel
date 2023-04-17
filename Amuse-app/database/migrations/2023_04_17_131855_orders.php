<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('userId');
                $table->unsignedBigInteger('gameId');
                $table->timestamps();
    
                $table->foreign('userId')->references('id')->on('users');
                $table->foreign('gameId')->references('id')->on('games');
            });
        }
    }
    
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['gameId']);
            $table->dropForeign(['userId']);
        });
    
        Schema::dropIfExists('orders');
    }
}    
