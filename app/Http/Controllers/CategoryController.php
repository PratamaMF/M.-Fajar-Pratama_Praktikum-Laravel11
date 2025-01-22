<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     * 
     * @return View
     */
    public function index(): View
    {
        $categories = Category::latest()->paginate(10);

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     * 
     * @return View
     */
    public function create(): View
    {
        return view('category.create');
    }

    /**
     * Store a newly created category in storage.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([ 
            'name' => 'required|min:5'
        ]); 

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('category.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Show the form for editing the specified category.
     * 
     * @param string $id
     * @return View
     */
    public function edit(string $id): View
    {
        $categories = Category::findOrFail($id);
        
        return view('category.edit', compact('categories'));
    }

    /**
     * Update the specified category in storage.
     * 
     * @param Request $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:5'
        ]);

        $categories = Category::findOrFail($id);

        $categories->update([
            'name' => $request->name
        ]);
        
        return redirect()->route('category.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified category from storage.
     * 
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $categories = Category::findOrFail($id);
        $categories->delete();

        return redirect()->route('category.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function printCatPdf()
    {
        $categories = Category::get();
        $data = [
            'title' => 'Welcome To fti.uniska-bjm.ac.id',
            'date' => date('m/d/Y'),
            'categories' => $categories
        ];
    
        // Memanggil metode loadView menggunakan facade
        $pdf = PDF::loadView('category.categorypdf', $data);
        $pdf->setPaper('A4', 'landscape');
    
        return $pdf->stream('Data Category.pdf', ["attachment" => false]);
    }
}
