<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('region_id')->nullable();
            $table->bigInteger('code')->nullable()->unique();
            $table->string('name');
            $table->uuid('type_id');
            $table->timestampsTz();

            $table->foreign('type_id')
                ->references('id')
                ->on('sep_types')
                ->onDelete('cascade');

            $table->foreign('region_id')
                ->references('id')
                ->on('regions')
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
        Schema::dropIfExists('seps');
    }
}
