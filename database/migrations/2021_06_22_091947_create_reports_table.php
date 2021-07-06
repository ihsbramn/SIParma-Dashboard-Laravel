<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id()->startingValue(1000);
            $table->string('report_type');
            $table->string('report_number');
            $table->string('report_value');
            $table->string('report_detail');
            $table->string('report_idsender');
            $table->string('report_sender');
            $table->string('report_status');
            $table->string('open_ogp')->nullable();
            $table->string('ogp_eskalasi')->nullable();
            $table->string('ogp_closed')->nullable();
            $table->string('eskalasi_closed')->nullable();
            $table->string('open_ogp_time')->nullable();
            $table->string('ogp_eskalasi_time')->nullable();
            $table->string('ogp_closed_time')->nullable();
            $table->string('eskalasi_closed_time')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
