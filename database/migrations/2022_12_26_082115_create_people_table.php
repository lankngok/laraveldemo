<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('province_id')->unsigned();
            $table->text('avatar', 200);
            $table->date('birthday')->useCurrent();
            $table->tinyInteger('gender')->default(1);
            $table->text('about')->nullable();

            $table->foreign('province_id')->references('id')->on('provinces');
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
        Schema::table('people', function(Blueprint $table){
            $table->dropForeign('people_province_id_foreign');
        });
        Schema::dropIfExists('people');
    }
};
