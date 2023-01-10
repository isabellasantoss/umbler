<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependentes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            // chave estrangeira
            $table->unsignedBigInteger('funcionario_id');
            $table->foreign('funcionario_id')->references('id')->on('funcionarios');

            // chave estrangeira
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');    

            // chave estrangeira
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('user_infos');            
            
            $table->string('name');
            $table->date('data_nascimento');
            $table->string('sexo');
            $table->string('tipo_dependente');
            $table->string('grau_titulo');
            $table->string('grau_status');
            $table->unsignedBigInteger('cpf')->unique();
            $table->unsignedBigInteger('rg')->unique();
            $table->string('celular');
            $table->string('telefone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dependentes');
    }
}
