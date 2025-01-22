<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;


class ProductController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index() : View
    {
        $products = Product::latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * create
     * 
     * @return View
     */
    public function create(): View
    {
        return view('products.create');
    }


    /**
     * store
     * 
     * @param mixed $request
     * @return RedirectResponse
     */

    public function store (Request $request): RedirectResponse
    {
        //validate form 
        $request->validate([ 
            'image'          => 'required|image|mimes:jpeg,jpg,png|max: 2048', 
            'title'          => 'required|min:5',
            'description'    => 'required|min:10',
            'price'          => 'required|numeric',
            'stock'          => 'required|numeric'
        ]); 
        
        $image = $request->file('image');

        $imagePath = $image->storeAs('products', $image->hashName(), 'public');

        //create product
        Product::create([
            'image'          => basename($imagePath),
            'title'          => $request->title,
            'description'    => $request->description,
            'price'          => $request->price,
            'stock'          => $request->stock
        ]);

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        //get product by ID
        $product = Product::findOrFail($id);
        //render view with product
        return view('products.show', compact('product'));
    }

    public function edit(string $id): View
    {
        //get product by ID
        $product = Product::findOrFail($id);
        //render view with product
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
        'image' => 'image|mimes:jpeg,jpg,png|max:2048',
        'title' => 'required|min:5',
        'description' => 'required|min:10',
        'price' => 'required|numeric',
        'stock' => 'required|numeric'
        ]);

        //get product by ID
        $product = Product::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {
            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());
            //delete old image
            Storage::delete('public/products/'.$product->image);
            //update product with new image
            $product->update([
            'image' => $image->hashName(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
            ]);
        } else {
            //update product without image
            $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);
        }
        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        //get product by ID
        $product = Product::findOrFail($id);
        //delete image
        Storage::delete('public/products/'. $product->image);
        //delete product
        $product->delete();
        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function printProductPDF()
    {
        $products = Product::get();
        $data = [
            'title' => 'Welcome To fti.uniska-bjm.ac.id',
            'date' => date('m/d/Y'),
            'products' => $products
        ];
    
        // Memanggil metode loadView menggunakan facade
        $pdf = PDF::loadView('products.productpdf', $data);
        $pdf->setPaper('A4', 'landscape');
    
        return $pdf->stream('Data Product.pdf', ["attachment" => false]);
    }

}