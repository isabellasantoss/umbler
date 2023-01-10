<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) 
        {
             
            $table->id();
            $table->timestamps();

            // chave estrangeira
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            // E-mail
            $table->string('emails', 200);

            // Dados empresa
            $table->unsignedBigInteger('cnpj');
            $table->string('razao_social', 50);
            $table->string('nome_fantasia', 60);
            $table->string('atividade', 80);
            $table->string('cct', 80);

            // Endereço
            $table->unsignedBigInteger('cep');
            $table->string('logradouro', 100);
            $table->unsignedBigInteger('numero');
            $table->string('complemento', 50)->nullable();
            $table->string('bairro', 100);
            $table->string('estado', 5);
            $table->string('cidade', 30);
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_infos');
    }
}