<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('author_id')->unsigned();
            $table->smallInteger('year');
            $table->softDeletes();
            $table->foreign('author_id')->references('id')->on('author')->onDelete('cascade');
        });

        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birth_date');
            $table->string('genre');
        });


        Schema::create('libraries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
        });

        Schema::create('books_to_libraries', function (Blueprint $table) {
            $table->integer('book_id')->unsigned();
            $table->integer('library_id')->unsigned();
            $table->unique(['book_id', 'library_id']);
            $table->foreign('book_id')->references('id')->on('book')->onDelete('cascade');
            $table->foreign('library_id')->references('id')->on('library')->onDelete('cascade');            
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
        Schema::dropIfExists('authors');
        Schema::dropIfExists('libraries');
        Schema::dropIfExists('books_to_libraries');
    }
}
