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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('code')->unique();
            $table->dateTime('conclusion');
            $table->dateTime('expiration');
            $table->json('ware')->nullable()->comment('(DC2Type:json_array)');
            $table->json('courier')->nullable()->comment('(DC2Type:json_array)');
            $table->json('supply')->nullable()->comment('(DC2Type:json_array)');
            $table->json('order')->nullable()->comment('(DC2Type:json_array)');
            $table->json('info')->nullable()->comment('(DC2Type:json_array)');
            $table->json('roles')->nullable()->comment('(DC2Type:simple_json_array)');
            $table->json('data')->nullable()->comment('(DC2Type:json_array)');
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
        Schema::dropIfExists('contracts');
    }
};
