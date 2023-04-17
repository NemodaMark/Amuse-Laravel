<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersTableUpdate extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('roleId')->nullable();
            $table->foreign('roleId')->references('id')->on('roles');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['roleId']);
            $table->dropColumn('roleId');
        });
    }
}

class AddForeignKeysToTables extends Migration
{
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->unsignedBigInteger('genreID');
            $table->foreign('genreID')->references('id')->on('genres');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('gameId');
            $table->foreign('gameId')->references('id')->on('games');
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['gameId']);
            $table->dropForeign(['userId']);
            $table->dropColumn(['gameId', 'userId']);
        });

        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign(['genreID']);
            $table->dropColumn('genreID');
        });
    }
};