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
        Schema::create('submission_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->unsignedInteger('version_number');
            $table->text('change_log')->nullable();
            $table->timestamps();
        
            $table->unique(['submission_id','version_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submission_versions');
    }
};
