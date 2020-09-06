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
            $table->longText('short_kpic_code')->nullable();
            $table->longText('hash')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('yob');
            $table->string('mob');
            $table->uuid('sep_id');
            $table->timestampsTz();

            $table->foreign('sep_id')
                ->references('id')
                ->on('seps')
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
