<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->bigincrements('id')->unsigned();
            $table->unsignedBigInteger('landing_id');
            $table->string('title');
            $table->string('submission_link');
            $table->string('method');
            $table->string('data_type');
            $table->unsignedInteger('total_entries')->default(0);
            $table->unsignedInteger('valid_entries')->default(0);
            $table->timestamps();

            $table->foreign('landing_id')->references('id')->on('landings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}
