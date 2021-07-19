<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAuditTrailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('audit_trails', function (Blueprint $table) {
            $table->index('sep_id');
            $table->index('user_id');
            $table->index('patient_id');
            $table->index('action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('audit_trails', function (Blueprint $table) {
            $table->dropIndex(['sep_id']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['patient_id']);
            $table->dropIndex(['action']);
        });
    }
}
