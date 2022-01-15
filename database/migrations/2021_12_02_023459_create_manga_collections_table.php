<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMangaCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manga_collections', function (Blueprint $table) {
            $table->id();
            $table->string('type', 100)->index();
            $table->string('name', 150);
            $table->string('slug', 150);
            $table->timestamps();

            $table->index(['type', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manga_collections');
    }
}
