<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredefinedFieldOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predefined_field_options', function (Blueprint $table) {
            $table->bigincrements('id')->unsigned();
            $table->unsignedBigInteger('predefined_field_id');
            $table->string('value');
            $table->boolean('valid')->default(1);
            $table->timestamps();

            $table->foreign('predefined_field_id')->references('id')->on('predefined_fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('predefined_field_options');
    }
}
