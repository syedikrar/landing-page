<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcceptenceCriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acceptence_criteria', function (Blueprint $table) {
            $table->bigincrements('id')->unsigned();
            $table->unsignedBigInteger('form_id')->constraint();
            $table->mediumText('name');
            $table->mediumText('leading_status')->nullable();            
            $table->mediumText('match_type')->nullable();     
            $table->mediumText('forwarding_status')->nullable();     
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
        Schema::dropIfExists('acceptence_criteria');
    }
}
