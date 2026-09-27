<?php

namespace App\Http\Controllers;

use App\Models\Counties;
use Illuminate\Http\Request;

class CountiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $counties = Counties::query()
            ->withSum('cities', 'population')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->get();

        return view('counties.index', compact('counties', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('counties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "coat_of_arms_url" => "nullable|url",
        ]);

        $county = new Counties();
        $county->name = $request->name;
        $county->coat_of_arms_url = $request->coat_of_arms_url;
        $county->timestamps = false;
        $county->save();

        return redirect()->route('counties.index')->with('success', 'County added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $county = Counties::withSum('cities', 'population')->findOrFail($id);

        return view("counties.show", compact("county"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $county = Counties::findOrFail($id);

        return view("counties.edit", compact("county"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required",
            "coat_of_arms_url" => "nullable|url",
        ]);

        $county = Counties::findOrFail($id);
        $county->name = $request->name;
        $county->coat_of_arms_url = $request->coat_of_arms_url;
        $county->timestamps = false;
        $county->save();

        return redirect()->route("counties.index")->with("success", "County edited");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $county = Counties::findOrFail($id);
        $county->delete();

        return redirect()->route("counties.index")->with("success", "County deleted successfully");
    }
}
