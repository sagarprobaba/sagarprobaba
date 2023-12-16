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
        Schema::create('address_verifications', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('candidateName',150)->nullable()->nullable(); 
            $table->string('checkId',150)->nullable();
            $table->text('completeAddress')->nullable();
            $table->string('periodOfStay',250)->nullable();
            $table->string('documentProofAttached',250)->nullable();
            $table->string('respondentName',250)->nullable();
            $table->string('respondentContactDetails',250)->nullable();            
            $table->string('respondentSignature',250)->nullable();
            $table->string('additionalComment',250)->nullable();       
            $table->date('dateOfVisit')->nullable();             
            $table->string('a1',150)->nullable();
            $table->string('a2',150)->nullable();
            $table->string('a3',150)->nullable();
            $table->string('a4',150)->nullable();
            $table->string('a5',150)->nullable();
            $table->string('a6',150)->nullable();
            $table->string('a7',150)->nullable();
            $table->string('a8',150)->nullable();
            $table->string('a9',150)->nullable();
            $table->string('a10',150)->nullable();
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
        Schema::dropIfExists('address_verifications');
    }
};
