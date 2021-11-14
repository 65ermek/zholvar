<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->string('num')->nullable()->comment('Номер заказа');
            $table->string('barcode')->nullable()->comment('Штрих-код');
            $table->string('phone', 20)->comment('Номер телефона получателя');
            $table->string('name')->comment('Имя получателя');
            $table->string('last_name')->nullable()->comment('Фамилия получателя');
            $table->string('email')->nullable()->comment('Email получателя');
            $table->decimal('insurance')->nullable()->comment('Страховая стоимость');
            $table->decimal('weight')->nullable()->comment('Вес посылки');
            $table->enum('status', ['pending_reception', 'in_transit', 'delivered'])->comment('Cтатус')->default('pending_reception');
            $table->bigInteger('user_id')->comment('Отправитель')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->bigInteger('parcelsender_id')->comment('Отправитель')->unsigned()->nullable();
            $table->foreign('parcelsender_id')
                ->references('id')
                ->on('parcel_senders')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->bigInteger('packagerecepient_id')->comment('Пункт приёма-выдачи')->unsigned()->nullable();
            $table->foreign('packagerecepient_id')
                ->references('id')
                ->on('package_recepients')
                ->onDelete('restrict')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('parcels');
    }
}
