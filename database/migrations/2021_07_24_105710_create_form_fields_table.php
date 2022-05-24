<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->bigincrements('id')->unsigned();
            $table->unsignedBigInteger('form_section_id');
            $table->string('type');
            $table->string('label');
            $table->boolean('hide_label')->default(0);
            $table->string('attribute_name');
            $table->string('placeholder')->nullable();
            $table->string('validation_rule')->nullable();
            $table->string('valid_input')->nullable();
            $table->boolean('all_valid')->nullable();
            $table->date('valid_date_from')->nullable();
            $table->date('valid_date_to')->nullable();
            $table->boolean('required');
            $table->timestamps();

            $table->foreign('form_section_id')->references('id')->on('form_sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_fields');
    }
}
