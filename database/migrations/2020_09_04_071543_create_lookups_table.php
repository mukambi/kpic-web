<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLookupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lookups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->json('duplicate_patient_ids')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('yob');
            $table->string('month');
            $table->integer('year');
            $table->uuid('pcn_id');
            $table->uuid('sep_id');
            $table->timestampsTz();

            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
                ->onDelete('cascade');

            $table->foreign('pcn_id')
                ->references('id')
                ->on('pcns')
                ->onDelete('cascade');

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
        Schema::dropIfExists('lookups');
    }
}
