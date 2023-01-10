<?php

namespace App\Http\Middleware\Funcionario;

use App\Models\admin\logs\LogFuncionario;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogExcluir
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        LogFuncionario::create(['log' => LogFuncionario::MSG_LOG_EXCLUSAO, 'user_id' => Auth::user()->id, 'ip' => $request->server->get('REMOTE_ADDR')]);
        return $next($request);
    }
}
