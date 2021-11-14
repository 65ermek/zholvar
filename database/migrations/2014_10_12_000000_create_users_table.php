<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone', 20)->comment('Номер телефона')->nullable();
            $table->string('num', 20)->comment('Порядковый номер')->nullable();
            $table->enum('status', ['active', 'not_active'])->comment('Cтатус')->default('not_active');
            $table->enum('type', ['company', 'e_shop', 'person'])->comment('Cтатус')->default('company');
            $table->string('last_name')->nullable()->comment('Имя Фамилия');
            $table->string('ico')->nullable();
            $table->string('dic')->nullable();
            $table->string('street')->comment('Улица и номер дома')->nullable();
            $table->string('post')->comment('Почтовый индекс')->nullable();
            $table->string('city')->nullable()->comment('Населённый пункт');
            $table->string('state')->nullable()->comment('Страна');
            $table->string('web', 100)->comment('Веб-адрес')->nullable();
            $table->text('description')->nullable()->comment('Описание');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
