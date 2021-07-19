<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('kpic_code', 10)->nullable()->change();
            $table->index('kpic_code');
            $table->index('sep_id');
            $table->index('icon_id');
            $table->index('creator_id');
            $table->index('possible_duplicate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->longText('kpic_code')->nullable()->change();
            $table->dropIndex(['kpic_code']);
            $table->dropIndex(['sep_id']);
            $table->dropIndex(['icon_id']);
            $table->dropIndex(['creator_id']);
            $table->dropIndex(['possible_duplicate']);
        });
    }
}
