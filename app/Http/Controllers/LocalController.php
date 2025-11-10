<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
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
        $locais = Local::withCount(['partidas', 'avaliacoes'])
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('admin.index', compact('locais'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locais = Local::withCount(['partidas', 'avaliacoes'])
                      ->orderBy('created_at', 'desc')
                      ->get();

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
            $file = $request->file('imagem');
            $imageData = base64_encode(file_get_contents($file->getRealPath()));

            // Envia a imagem para o ImgBB
            $response = Http::asForm()->post('https://api.imgbb.com/1/upload', [
                'key' => env('IMGBB_KEY'),
                'image' => $imageData,
            ]);

            // Verifica se o upload foi bem-sucedido
            if ($response->successful()) {
                $dados['imagem'] = $response->json()['data']['url'];
            } else {
                return back()->withErrors(['imagem' => 'Falha ao enviar imagem para o ImgBB.']);
            }
        }

        Local::create($dados);

        return redirect()->route('local.index')->with('success', 'Local criado com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Local $local)
    {
        $local->load(['partidas', 'avaliacoes']);

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
            $file = $request->file('imagem');
            $imageData = base64_encode(file_get_contents($file->getRealPath()));

            $response = Http::asForm()->post('https://api.imgbb.com/1/upload', [
                'key' => env('IMGBB_KEY'),
                'image' => $imageData,
            ]);

            if ($response->successful()) {
                $dados['imagem'] = $response->json()['data']['url'];
            } else {
                return back()->withErrors(['imagem' => 'Falha ao enviar imagem para ImgBB.']);
            }
        }

        $local->update($dados);

        return redirect()->route('local.index')->with('success', 'Local atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Local $local)
    {
        $local->delete();

        return redirect()->route('local.index')->with('success', 'Local removido com sucesso!');
    }
}
