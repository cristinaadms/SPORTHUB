<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocalRequest;
use App\Http\Requests\UpdateLocalRequest;
use App\Models\Local;

class LocalController extends Controller
{
    /**
     * Display the admin dashboard for managing locations.
     */
    public function adminIndex()
    {
        $locais = Local::orderBy('created_at', 'desc')->get();

        return view('exclusivo-adm', compact('locais'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locais = Local::all();

        return view('locais.index', compact('locais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locais.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocalRequest $request)
    {
        $dados = $request->validated();

        if ($request->hasFile('imagem')) {
            $dados['imagem'] = file_get_contents($request->file('imagem')->getRealPath());
        }

        Local::create($dados);

        return redirect()->route('locais.index')->with('success', 'Local criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Local $local)
    {
        return view('locais.show', compact('local'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Local $local)
    {
        return view('locais.edit', compact('local'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocalRequest $request, Local $local)
    {
        $dados = $request->validated();

        if ($request->hasFile('imagem')) {
            $dados['imagem'] = file_get_contents($request->file('imagem')->getRealPath());
        }

        $local->update($dados);

        return redirect()->route('locais.index')->with('success', 'Local atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Local $local)
    {
        $local->delete();

        return redirect()->route('locais.index')->with('success', 'Local removido com sucesso!');
    }
}
