<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('submission_attachments', function (Blueprint $table) {
            // primeiro drope a foreign key
            $table->dropForeign(['submission_id']);
            // então drope a coluna
            $table->dropColumn('submission_id');
        });
    }

    public function down()
    {
        Schema::table('submission_attachments', function (Blueprint $table) {
            $table->foreignId('submission_id')
                  ->after('id')
                  ->constrained()
                  ->onDelete('cascade');
        });
    }
};
