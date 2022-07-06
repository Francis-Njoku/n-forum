<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class, 'user_id');
            $table->timestamp('dob')->nullable();
            $table->string('gender', 20);
            $table->string('location', 50);
            $table->string('twitter');
            $table->string('facebook');
            $table->string('instagram');
            $table->tinyInteger('dob_status');
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
        Schema::dropIfExists('profile');
    }
}
