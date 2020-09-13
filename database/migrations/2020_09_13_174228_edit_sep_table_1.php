<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditSepTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seps', function (Blueprint $table) {
            $table->dropColumn(['location', 'geocode']);
            $table->bigInteger('code')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seps', function (Blueprint $table) {
            $table->string('location');
            $table->bigInteger('code')->unique();
            $table->longText('geocode')->nullable();
        });
    }
}
