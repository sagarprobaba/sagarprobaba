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
        Schema::create('seller_reviews', function (Blueprint $table) {
            $table->id()->autoIncrement();           
            $table->string('user_id',255)->nullable(); 
            $table->string('seller_id',255)->nullable();
            $table->string('name',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('rating',255)->nullable();
            $table->text('review_title')->nullable();
            $table->text('review')->nullable();
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
        Schema::dropIfExists('seller_reviews');
    }
};
