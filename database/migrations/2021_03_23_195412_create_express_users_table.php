<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpressUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express_users', function (Blueprint $table) {
            $table->id();
            $table->string('user_phone', 15);
            $table->string('user_name', 40);
            $table->string('user_bonus', 5);
            $table->string('user_count', 5);
            $table->string('user_client_card', 20);
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
        Schema::dropIfExists('express_users');
    }
}
