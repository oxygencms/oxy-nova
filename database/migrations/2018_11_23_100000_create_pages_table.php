<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');

            $table->boolean('active')->default(1);

            $table->string('name')->unique()->index();

            $table->string('layout')
                  ->default(config('oxygen.page_default_layout'));

            $table->string('template')
                  ->default(config('oxygen.page_default_template'));

            $table->json('slug');
            $table->json('title');
            $table->json('summary')->nullable();
            $table->json('body')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->json('meta_description')->nullable();
            $table->json('meta_tags')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('pages');
    }
}
