<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
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
          $table->foreignId('event_id')->constrained()->onDelete('cascade');
          $table->string('title');
          $table->dateTime('start');
          $table->dateTime('end');
          $table->boolean('book')->nullable()->default(false);
          $table->dateTime('book_until')->nullable();
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
        Schema::dropIfExists('books');
    }
}
