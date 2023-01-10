<?php

namespace App\Models\admin\logs;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogFuncionario extends Model
{
    use HasFactory;

    protected $fillable = ['log', 'user_id', 'ip'];

    // mensagens de log
    CONST MSG_LOG_ACESSO = 'Acessou dados relacionados a funcionários';
    CONST MSG_LOG_CADASTRO = 'Acessou a rota para inserir dados de um novo funcionário';
    CONST MSG_LOG_EDICAO = 'Acessou a rota para atualizar dados relacionados a funcionários';
    CONST MSG_LOG_EXCLUSAO = 'Acessou a rota para excluir dados relacionados a funcionários';

    CONST MSG_LOG_INSERIR = 'Inseriu novo funcionário';
    CONST MSG_LOG_UPDATE = 'Atualizou funcionpario';
    CONST MSG_LOG_DELETE = 'Excluiu funcionário';
    CONST MSG_LOG_ERROR = 'Deparou-se com um erro inesperado';


    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
