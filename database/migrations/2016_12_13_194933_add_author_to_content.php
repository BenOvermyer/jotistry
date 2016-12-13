<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthorToContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('author_id')->unsigned();
            $table->index('author_id');
        });

        Schema::table('task_categories', function (Blueprint $table) {
            $table->integer('author_id')->unsigned();
            $table->index('author_id');
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->integer('author_id')->unsigned();
            $table->index('author_id');
        });

        Schema::table('journalentries', function (Blueprint $table) {
            $table->integer('author_id')->unsigned();
            $table->index('author_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropIndex('author_id_index');
            $table->dropColumn('author_id');
        });

        Schema::table('task_categories', function (Blueprint $table) {
            $table->dropIndex('author_id_index');
            $table->dropColumn('author_id');
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->dropIndex('author_id_index');
            $table->dropColumn('author_id');
        });

        Schema::table('journalentries', function (Blueprint $table) {
            $table->dropIndex('author_id_index');
            $table->dropColumn('author_id');
        });
    }
}
