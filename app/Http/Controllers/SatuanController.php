<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SatuanController extends Controller
{
    /**
     * Display a listing of the satuans.
     * 
     * @return View
     */
    public function index(): View
    {
        $satuans = Satuan ::latest()->paginate(10);

        return view('satuan.index', compact('satuans'));
    }

    /**
     * Show the form for creating a new satuan.
     * 
     * @return View
     */
    public function create(): View
    {
        return view('satuan.create');
    }

    /**
     * Store a newly created satuan in storage.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([ 
            'name' => 'required|min:5',
            'description' => 'required|min:10'
        ]); 

        Satuan::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('satuan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Show the form for editing the specified satuan.
     * 
     * @param string $id
     * @return View
     */
    public function edit(string $id): View
    {
        $satuans = Satuan::findOrFail($id);
        
        return view('satuan.edit', compact('satuans'));
    }

    /**
     * Update the specified satuan in storage.
     * 
     * @param Request $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required|min:10'
        ]);

        $satuans = Satuan::findOrFail($id);

        $satuans->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        
        return redirect()->route('satuan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified satuan from storage.
     * 
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $satuans = Satuan::findOrFail($id);
        $satuans->delete();

        return redirect()->route('satuan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
