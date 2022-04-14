<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')
                ->nullable(false)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('image_id')
                ->nullable(false)
                ->constrained()
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->text('description'); //TODO возможно ли использование текста в слайдах
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_images');
    }
};
