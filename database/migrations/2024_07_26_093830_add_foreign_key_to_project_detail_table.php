<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToProjectDetailTable extends Migration
{
    public function up()
    {
        Schema::table('project_details', function (Blueprint $table) {
            $table->foreign('project_id')
                  ->references('id')
                  ->on('projects')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('project_detail', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
        });
    }
}
