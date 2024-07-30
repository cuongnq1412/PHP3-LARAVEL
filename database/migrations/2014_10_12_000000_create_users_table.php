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
            Schema::create('users',function(Blueprint $table){
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->enum('role', ['admin', 'user']);
                $table->timestamps();
            });
            Schema::create('categories',function (Blueprint $table) {
                $table->id();
                $table->string('name',100);
                $table->text('description');
                $table->string('img_category');

                $table->timestamps();
            });
            Schema::create('articles',function (Blueprint $table) {
                $table->id();
                $table->string('title',100);
                $table->text('short_description');
                $table->text('content');
                $table->foreignId('author_id')->constrained('users','id')->onDelete('cascade');
                $table->foreignId('category_id')->constrained('categories','id')->onDelete('cascade');
                $table->integer('views');
                $table->string('keymeta');
                $table->string('keytitle');
                $table->text('keycontent');
                $table->integer('status');
                $table->string('image_url');
                $table->timestamps();
            });
            Schema::create('comments',function (Blueprint $table) {

                $table->id();
                $table->foreignId('article_id')->constrained('articles','id')->onDelete('cascade');
                $table->foreignId('user_id')->constrained('users','id')->onDelete('cascade');
                $table->text('comment');
                $table->integer('status_cmt');
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
        Schema::dropIfExists('users');
    }
};
