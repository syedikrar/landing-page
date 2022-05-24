<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBtnColorColumnsToFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->string('btn_text')->nullable()->after('title');
            $table->string('btn_bg_color')->nullable()->after('btn_text');
            $table->string('btn_color')->nullable()->after('btn_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->dropColumn('btn_color');
            $table->dropColumn('btn_bg_color');
            $table->dropColumn('btn_text');
        });
    }
}
