<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historys', function (Blueprint $table) {
            $table->increments('History_id');
            $table->unsignedInteger('Book_id');
            $table->foreign('Book_id')->references('Book_id')->on('books')->onDelete('cascade');
            $table->unsignedInteger('Borrower_id');
            $table->foreign('Borrower_id')->references('Borrower_id')->on('borrowers')->onDelete('cascade');
            $table->string('Date_Returned');
            $table->string('Date_Borrowed');
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
        Schema::dropIfExists('history');
    }
}
