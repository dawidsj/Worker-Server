<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class ForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('user_boards', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::connection('mysql')->table('user_boards', function (Blueprint $table) {
            $table->foreign('board_id')->references('id')->on('boards');
        });
        Schema::connection('mysql')->table('boards', function (Blueprint $table) {
            $table->foreign('owner_id')->references('id')->on('users');
        });
        Schema::connection('mysql')->table('lists', function (Blueprint $table) {
            $table->foreign('board_id')->references('id')->on('boards');
        });
        Schema::connection('mysql')->table('tasks', function (Blueprint $table) {
            $table->foreign('list_id')->references('id')->on('lists');
        });
        Schema::connection('mysql')->table('tasks', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
        });
        Schema::connection('mysql')->table('tasks', function (Blueprint $table) {
            $table->foreign('assigned_to')->references('id')->on('users');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
