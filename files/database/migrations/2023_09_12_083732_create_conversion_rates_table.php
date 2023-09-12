<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversion_rates', function (Blueprint $table) {
            $table->id();
            $table->decimal('dollar', 5, 1);
            $table->decimal('pounds', 5, 1);
            $table->decimal('euro', 5, 1);
            $table->timestamps();
        });

        Artisan::call('db:seed', array('--class' => 'ConversionRateSeeder'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversion_rates');
    }
};
