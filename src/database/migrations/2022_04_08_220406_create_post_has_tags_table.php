<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostHasTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_has_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->unsigned()->index();
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')->onDelete('cascade');
            $table->foreignId('tag_id')->unsigned()->index();
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_has_tags');
    }
}
