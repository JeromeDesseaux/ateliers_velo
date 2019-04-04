<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('place')->nullable();
            $table->text('description');
            $table->string('image')->nullable();
            $table->enum('status', ['submitted', 'validated','refused'])->default('submitted');
            $table->integer('zipcode')->unsigned();
            $table->boolean('automatic_validation')->default(0);
            $table->string('city');
            $table->dateTime('date');
            $table->double('latitude');
            $table->double('longitude');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('workshop_categories')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('workshops');
    }
}
