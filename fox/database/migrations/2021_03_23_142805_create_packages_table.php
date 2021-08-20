<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('user_phone_sender',50);
            $table->string('point_num',50);
            $table->string('point_id_s',50);
            $table->string('point_address',50);
            $table->string('pack_descr',50);
            $table->string('pack_weight',50);
            $table->string('pack_length',50);
            $table->string('pack_width',50);
            $table->string('pack_height',50);
            $table->string('phone_phone_recive',50);
            $table->string('city_id',50);
            $table->string('point_id',50);
            $table->string('pay_beznal',50);
            $table->string('pay',50);
            $table->string('pay_reciver',50);
            $table->string('order_num',50);
            $table->string('status_msg',250);
            $table->string('status_id',250);
            $table->string('timePkgCreate',250);
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
        Schema::dropIfExists('packages');
    }
}
