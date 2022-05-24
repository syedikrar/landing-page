<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredefinedFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predefined_fields', function (Blueprint $table) {
            $table->bigincrements('id')->unsigned();
            $table->string('type');
            $table->string('label');
            $table->string('attribute_name');
            $table->string('placeholder')->nullable();
            $table->string('validation_rule')->nullable();
            $table->string('valid_input')->nullable();
            $table->boolean('required');
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
        Schema::dropIfExists('predefined_fields');
    }
}
