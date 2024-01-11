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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name');
            $table->integer('sort_order')->unique();
            $table->string('branch_identifier')->nullable();
            $table->date('contact_period');
            $table->string('phone_no');
            $table->string('email');
            $table->string('user_id');
            $table->integer('status')->comment("0:expired, 1:active");
            $table->boolean('is_disable')->default(false);
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
        Schema::dropIfExists('shops');
    }
};
