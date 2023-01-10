<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Dados do funcionário
            $table->unsignedBigInteger('cpf')->unique();
            $table->string('matricula', 60);

            $table->string('name', 100);
            $table->string('nome_mae', 100);
            $table->string('email')->unique();
            $table->string('nacionalidade', 30);
            $table->string('naturalidade', 30);
            $table->string('sexo', 20);

            // chave estrangeira
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('user_infos');            

            $table->date('data_admissao');
            $table->date('data_nascimento');
            $table->string('estado_civil', 30);
            
            $table->unsignedBigInteger('rg')->unique();
            $table->date('data_emissao_rg');
            $table->string('orgao_emissor_rg');
            $table->string('estado_emissor_rg');
            $table->date('data_casamento')->nullable();

            // Endereço
            $table->unsignedBigInteger('cep');
            $table->string('logradouro', 100);
            $table->string('numero');
            $table->string('complemento', 50)->nullable();
            $table->string('bairro', 100);
            $table->string('estado', 5);
            $table->string('cidade', 30);

            $table->string('telefone', 30)->nullable();
            $table->string('celular', 30);
            $table->string('cartao_ativo', 3);
            $table->unsignedBigInteger('numeracao_cartao');
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
        Schema::dropIfExists('funcionarios');
    }
}
