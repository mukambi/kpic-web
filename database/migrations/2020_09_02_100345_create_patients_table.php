<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->longText('kpic_code')->nullable();
            $table->uuid('sep_id');
            $table->uuid('icon_id');
            $table->boolean('possible_duplicate');
            $table->timestampsTz();

            $table->foreign('sep_id')
                ->references('id')
                ->on('seps')
                ->onDelete('cascade');

            $table->foreign('icon_id')
                ->references('id')
                ->on('icons')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
