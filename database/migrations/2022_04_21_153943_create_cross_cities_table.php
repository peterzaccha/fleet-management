<?php

use App\Models\City;
use App\Models\Trip;
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
        Schema::create('cross_cities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Trip::class);
            $table->foreignIdFor(City::class);
            $table->unsignedInteger("order");
            $table->unsignedInteger("empty_seats")->default(12);
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
        Schema::dropIfExists('cross_cities');
    }
};
