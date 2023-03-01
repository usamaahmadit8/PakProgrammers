<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_points', function (Blueprint $table) {
            $table->id();
            $table->integer("language_id");
            $table->integer("category_id");
            $table->integer("heading_id");
            $table->integer("interview_ans_id");
            $table->string("sub_heading");
            $table->string("description");
            $table->string("image");
            $table->string("code");
            $table->string("output");
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
        Schema::dropIfExists('interview_points');
    }
}
