<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landings', function (Blueprint $table) {
            $table->bigincrements('id')->unsigned();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('campaign_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('template_id')->nullable();
            $table->string('name');
            $table->enum('type',['cpa','cpc','cpl']);
            $table->text('domain')->nullable();
            $table->enum('status',['active','inactive', 'requested', 'rejected'])->default('inactive');
            $table->enum('previous_status', ['active', 'inactive', 'requested', 'rejected'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landings');
    }
}
