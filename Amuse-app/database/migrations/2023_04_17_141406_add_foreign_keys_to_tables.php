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
        Schema::table('games', function (Blueprint $table) {
            $table->unsignedBigInteger('genreID');
            $table->foreign('genreID')->references('id')->on('genres');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('gameId');
            $table->foreign('gameId')->references('id')->on('games');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('roleId');
            $table->foreign('roleId')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign(['genreID']);
            $table->dropColumn('genreID');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['gameId']);
            $table->dropForeign(['userId']);
            $table->dropColumn(['gameId', 'userId']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['roleId']);
            $table->dropColumn('roleId');
        });
    }
};
