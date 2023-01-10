<?php

namespace App\Http\Controllers\admin\empresas;

use App\Exports\ConvencoesExport;
use App\Http\Controllers\Controller;
use App\Models\admin\empresas\CCT;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CCTsController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $convencoes = CCT::where('cct', 'like', '%' . $search . '%')
                ->orWhere('sind_patronal', 'like', '%' . $search . '%')
                ->orWhere('sind_laboral', 'like', '%' . $search . '%')
                ->orWhere('abrang', 'like', '%' . $search . '%')
                ->paginate(3);
        } else {
            $convencoes = CCT::paginate(3);
        }

        return view('convencoes.grid', ['convencoes' => $convencoes]);
    }

    public function create()
    {
        return view('convencoes.form', ['convencoes' => CCT::all()]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'cct' => 'required',
                'sind_patronal' => 'required',
                'sind_laboral' => 'required',
                'abrang' => 'required',
            ],

            [
                'cct.required' => 'O campo de CCT não foi preenchido.',
                'sind_patronal.required' => 'O campo de sindicato patronal não foi preenchido.',
                'sind_laboral.required' => 'O campo de sindicato laboral não foi preenchido.',
                'abrang.required' => 'O campo de abrangência não foi preenchido.',
            ]
        );

        try {
            CCT::create($request->all());
            return redirect(route('convencoes.index'))->with('msg', 'Convenção cadastrada com sucesso.');
        } catch (\Throwable $th) {
            return redirect(route('convencoes.index'))->with('msg', 'Houve um erro inesperado.');
        }
    }

    public function show($id)
    {
        return view('convencoes.form-view', ['convencoes' => CCT::findOrFail(base64_decode($id))]);
    }

    public function edit($id)
    {
        return view('convencoes.form-edit', ['convencoes' => CCT::findOrFail(base64_decode($id))]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'cct' => 'required',
                'sind_patronal' => 'required',
                'sind_laboral' => 'required',
                'abrang' => 'required',
            ],

            [
                'cct.required' => 'O campo de CCT não foi preenchido.',
                'sind_patronal.required' => 'O campo de sindicato patronal não foi preenchido.',
                'sind_laboral.required' => 'O campo de sindicato laboral não foi preenchido.',
                'abrang.required' => 'O campo de abrangência não foi preenchido.',
            ]
        );

        try {
            CCT::findOrFail(base64_decode($id))->update($request->all());
            return redirect(route('convencoes.index'))->with('msg', 'Convenção atualizada com sucesso.');
        } catch (\Throwable $th) {
            return redirect(route('convencoes.index'))->with('msg', 'Houve um erro inesperado.');
        }

    }
    public function destroy($id)
    {
        try {
            CCT::findOrFail(base64_decode($id))->delete();
            return redirect(route('convencoes.index'))->with('msg', 'Convenção excluída com sucesso.');
        } catch (\Throwable $th) {
            return redirect(route('convencoes.index'))->with('msg', 'Houve um erro inesperado.');
        }

    }

    public function export()
    {
        $date = date('d-m-Y');
        return Excel::download(new ConvencoesExport, 'Relatório Geral - Convenções' . '-' . $date . '-' . '.xlsx');
    }

    public function jsonCCT($id)
    {
        return response()->json([CCT::findOrFail($id)]);
    }

}