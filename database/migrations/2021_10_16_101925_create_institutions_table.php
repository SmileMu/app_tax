<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
           $table->id();
            $table->string('inst_name');
          // $table->integer('tax_no');
            $table->bigInteger('type_id')->unsigned();

            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
           // $table->bigInteger("type_no")->unsigned()->nullable();
           // $table->foreign('type_no')->references('type_no')->on('types')
           // ->onDelete('cascade');
            $table->bigInteger('section_id')->unsigned();

            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->string('found_year');
            $table->string('location');
            $table->integer('phone_no');
            $table->string('email');
            $table->string('password');
            $table->timestamps();


            //fk

           //$table->foreign('type_no')->references('id')->on('types');
           // $table->foreign('section_no')->references('id')->on('sections');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institutions');
    }
}
