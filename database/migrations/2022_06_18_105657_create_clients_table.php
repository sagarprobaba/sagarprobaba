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
        Schema::create('clients', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('CompanyName',100);
            $table->string('CompanyEmail',50);
            $table->integer('CompanyPhone');
            $table->string('CompanyWebsite',50)->nullable();
            $table->text('CompanyAddress');
            $table->string('Country',50);
            $table->string('State',50);
            $table->string('City',50);
            $table->string('BankName',100)->nullable();
            $table->string('Branch',50)->nullable();
            $table->string('IFSC',20)->nullable();
            $table->string('AccountHolderName',50)->nullable();
            $table->string('AccountNumber',20)->nullable();
            $table->string('CancelCheque',50)->nullable();
            $table->string('TanNumber',20)->nullable();
            $table->string('GSTNumber',20)->nullable();
            $table->string('PanNumber',20)->nullable();
            $table->string('FirstName',50)->nullable();
            $table->string('LastName',50)->nullable();
            $table->string('EmailID',50)->nullable();
            $table->integer('MobileNo')->nullable();
            $table->string('Gender',20)->nullable();
            $table->string('Designation',50)->nullable();
            $table->string('type',5)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
