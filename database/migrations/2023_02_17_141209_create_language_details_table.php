<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguageDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language_details', function (Blueprint $table) {
            $table->id();
            $table->integer("language_id");
            $table->integer("lang_head_id");
            $table->integer("sub_head_id");
            $table->string("heading");
            $table->string("discription");
            $table->string("image");
            $table->string("code");
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
        Schema::dropIfExists('language_details');
    }
}
