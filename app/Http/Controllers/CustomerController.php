<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     * 
     * @return View
     */
    public function index(): View
    {
        $customers = Customer::latest()->paginate(10);

        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new customer.
     * 
     * @return View
     */
    public function create(): View
    {
        return view('customer.create');
    }

    /**
     * Store a newly created customer in storage.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([ 
            'nik' => 'required|min:5',
            'name' => 'required|min:5',
            'telp' => 'required|min:5',
            'email' => 'required|min:5',
            'alamat' => 'required|min:5'
        ]); 

        Customer::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'telp' => $request->telp,
            'email' => $request->email,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Show the form for editing the specified customer.
     * 
     * @param string $id
     * @return View
     */
    public function edit(string $id): View
    {
        $customers = Customer::findOrFail($id);
        
        return view('customer.edit', compact('customers'));
    }

    /**
     * Update the specified customer in storage.
     * 
     * @param Request $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'nik' => 'required|min:5',
            'name' => 'required|min:5',
            'telp' => 'required|min:5',
            'email' => 'required|min:5',
            'alamat' => 'required|min:5'
        ]);

        $customers = Customer::findOrFail($id);

        $customers->update([
            'nik' => $request->nik,
            'name' => $request->name,
            'telp' => $request->telp,
            'email' => $request->email,
            'alamat' => $request->alamat
        ]);
        
        return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified customer from storage.
     * 
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $customers = Customer::findOrFail($id);
        $customers->delete();

        return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
