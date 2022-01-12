<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_purchases', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('coin');
            $table->unsignedBigInteger('chapter_id');
            $table->unsignedBigInteger('manga_id');
            $table->timestamps();
            $table->primary([ 'user_id', 'chapter_id' ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_purchases');
    }
}
