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
            $table->foreignId('province_id')
                ->constrained('cities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('city_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('code',3)->unique();
            $table->smallInteger('level')->default(0);
            $table->smallInteger('status')->default(1);
            $table->json('info')->nullable()->comment('(DC2Type:json_array)');
            $table->json('contact')->nullable()->comment('(DC2Type:json_array)');
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
        Schema::dropIfExists('shops');
    }
};
