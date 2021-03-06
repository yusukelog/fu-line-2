<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable($value = true);
            $table->integer('tall')->nullable($value = true);
            //$table->integer('old')->nullable($value = true);
            $table->integer('bust')->nullable($value = true);
            $table->string('cup')->nullable($value = true);
            $table->integer('west')->nullable($value = true);
            $table->integer('hip')->nullable($value = true);
            $table->string('url')->nullable($value = true);
            $table->boolean('check')->nullable($value = true);
            $table->string('code')->nullable($value = true);
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
        Schema::dropIfExists('people');
    }
}
