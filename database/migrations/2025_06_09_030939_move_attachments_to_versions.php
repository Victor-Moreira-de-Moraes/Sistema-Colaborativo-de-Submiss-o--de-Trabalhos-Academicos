<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submission_attachments', function (Blueprint $table) {
            $table->foreignId('submission_version_id')
            ->after('id')
            ->nullable()
            ->constrained('submission_versions')
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
        Schema::table('submission_attachments', function (Blueprint $table) {
            //
        });
    }
};
