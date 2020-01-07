<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaptainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('captains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reg_no');
            $table->string('name');
            $table->date('bod'); 
            $table->string('relegion')->nullable();
            $table->string('gender');
            $table->string('nationality');
            $table->bigInteger('id_num')->unique();
            $table->string('phone')->unique();
            $table->string('phone2')->nullable();
            $table->string('password');
            $table->string('address');
            $table->string('edu_level');
            $table->string('service_id');
            $table->integer('state_id');
            $table->integer('district_id');
            $table->string('pic')->nullable();
            $table->string('note')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('captains');
    }
}
