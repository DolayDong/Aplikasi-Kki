<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('teman_id')->index();
            $table->unsignedBigInteger('postingan_id')->index();
            $table->integer('like_pada');

            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('teman_id')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('postingan_id')->on('postingans')->references('id')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
