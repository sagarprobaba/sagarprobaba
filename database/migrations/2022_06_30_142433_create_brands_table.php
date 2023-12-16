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
        Schema::create('brands', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('brandName',255)->nullable();
            $table->string('brandEmail',255)->nullable();
            $table->bigInteger('brandPhone')->nullable();
            $table->string('brandWebsite',255)->nullable();
            $table->string('brandIndustry',255)->nullable();
            $table->string('brandSegments',255)->nullable();
            $table->text('brandAddress')->nullable();
            $table->string('country',255)->nullable();
            $table->bigInteger('state')->nullable();
            $table->bigInteger('city')->nullable();
            $table->bigInteger('pincode')->nullable();
            $table->string('alias',255)->nullable();
            $table->string('gstNumber',255)->nullable();
            $table->string('panNumber',255)->nullable();
            $table->string('bankName',255)->nullable();
            $table->string('branch',255)->nullable();
            $table->string('ifsc',255)->nullable();
            $table->string('accountHolderName',255)->nullable();
            $table->bigInteger('accountNumber')->nullable();
            $table->string('cancelCheque',255)->nullable();
            $table->string('photo',255)->nullable();
            $table->string('firstName',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('mobile',255)->nullable();
            $table->string('gender',255)->nullable();
            $table->date('dob')->nullable();
            $table->text('warehouseAddress1')->nullable();
            $table->string('warehouseCountry1',255)->nullable();
            $table->bigInteger('warehouseState1')->nullable();
            $table->bigInteger('warehouseCity1')->nullable();
            $table->bigInteger('warehousePincode1')->nullable();
            $table->text('warehouseAddress2')->nullable();
            $table->string('warehouseCountry2',255)->nullable();
            $table->bigInteger('warehouseState2')->nullable();
            $table->bigInteger('warehouseCity2')->nullable();
            $table->bigInteger('warehousePincode2')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('brands');
    }
};
