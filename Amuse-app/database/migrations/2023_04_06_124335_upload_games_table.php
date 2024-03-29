<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UploadGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploadedGames', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('title');
            $table->double('price');
            $table->string('genreId');
            $table->dateTime('added');
            $table->bigInteger('creator');
            $table->text('description');
            $table->string('link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploadedGames');
    }
};
