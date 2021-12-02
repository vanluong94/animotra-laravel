<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->foreign('manga_id')->references('id')->on('mangas');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('manga_id')->references('id')->on('mangas');
            $table->foreign('chapter_id')->references('id')->on('chapters');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('user_purchases', function (Blueprint $table) {
            $table->foreign('manga_id')->references('id')->on('mangas');
            $table->foreign('chapter_id')->references('id')->on('chapters');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('user_coin_logs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('user_collections', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('manga_id')->references('id')->on('mangas');
        });

        Schema::table('manga_collection_relationships', function (Blueprint $table) {
            $table->foreign('collection_id')->references('id')->on('manga_collections');
            $table->foreign('manga_id')->references('id')->on('mangas');
        });

        Schema::table('user_notifications', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('password_resets', function(Blueprint $table) {
            $table->foreign('email')->references('email')->on('users');
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
