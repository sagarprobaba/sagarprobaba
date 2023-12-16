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
        Schema::create('employees', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('EmployeeName',100);
            $table->string('EmployeeEmail',50);
            $table->integer('EmployeePhone');
            $table->string('Gender',50)->nullable();
            $table->date('Dob')->nullable();
            $table->string('photo',50)->nullable();
            $table->text('EmployeeAddress');
            $table->string('Country',50);
            $table->string('State',50);
            $table->string('type',5)->nullable();
            $table->string('City',50);
            $table->string('WorkCategory',100)->nullable();
            $table->string('Skills',100)->nullable();
            $table->string('Experience',100)->nullable();
            $table->string('TransportationMode',100)->nullable();
            $table->string('PoliceCase',100)->nullable();
            $table->string('EducationLevel',100)->nullable();
            $table->string('TimeAvailability',100)->nullable();
            $table->string('OrientationStatus',100)->nullable();
            $table->string('RelevantStatus',100)->nullable();
            $table->string('WorkedWith',100)->nullable();
            $table->string('EmergencyContacts',100)->nullable();
            $table->string('BankName',100)->nullable();
            $table->string('Branch',50)->nullable();
            $table->string('IFSC',20)->nullable();
            $table->string('AccountHolderName',50)->nullable();
            $table->string('AccountNumber',20)->nullable();
            $table->string('CancelCheque',50)->nullable();
            $table->string('DlNumber',20)->nullable();
            $table->string('PanNumber',20)->nullable();
            $table->string('ChoosedocumType',20)->nullable();
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
        Schema::dropIfExists('employees');
    }
};
