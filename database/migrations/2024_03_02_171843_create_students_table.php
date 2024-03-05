<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id_etudiant');
            $table->string('nom', 255);
            $table->string('prenom', 255);
            $table->date('date_naissance');
            $table->string('email', 255);
            $table->string('telephone', 255);
            $table->string('adresse', 255);
            $table->unsignedInteger('id_filiere');
            $table->foreign('id_filiere')->references('id_filiere')->on('filieres');
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
        Schema::dropIfExists('students');
    }
}
