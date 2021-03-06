<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('id_moban');
            $table->foreign('id_moban')->references('id')->on('reports');
            $table->string('user_name');
            $table->string('no_order');
            $table->string('update_status');
            $table->integer('open_ogp_stat')->nullable();
            $table->integer('ogp_eskalasi_stat')->nullable();
            $table->integer('ogp_closed_stat')->nullable();
            $table->integer('eskalasi_closed_stat')->nullable();
            $table->integer('closed_stat')->nullable();
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
        Schema::dropIfExists('performances');
    }
}
