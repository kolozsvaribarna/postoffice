<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\Counties;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $countyId = $request->query('county_id');

        $cities = Cities::query()
            ->with('county')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($countyId, function ($query, $countyId) {
                $query->where('county_id', $countyId);
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $counties = Counties::orderBy('name')->get();

        return view('cities.index', compact('cities', 'counties', 'search', 'countyId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = Counties::orderBy('name')->get();

        return view('cities.create', compact('counties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "population" => "required|integer|min:1",
            "zip_code" => "required|integer|min:1|max:9999",
            "county_id" => "required|exists:counties,id",
        ]);

        $city = new Cities();
        $city->name = $request->name;
        $city->population = $request->population;
        $city->county_id = $request->county_id;
        $city->zip_code = $request->zip_code;
        $city->timestamps = false;
        $city->save();

        return redirect()->route("cities.index")->with("success", "City added successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $city = Cities::with('county')->findOrFail($id);

        return view("cities.show", compact("city"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city = Cities::findOrFail($id);
        $counties = Counties::orderBy('name')->get();

        return view("cities.edit", compact("city", "counties"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required",
            "population" => "required|integer|min:1",
            "zip_code" => "required|integer|min:1|max:9999",
            "county_id" => "required|exists:counties,id",
        ]);

        $city = Cities::findOrFail($id);
        $city->name = $request->name;
        $city->population = $request->population;
        $city->county_id = $request->county_id;
        $city->zip_code = $request->zip_code;
        $city->timestamps = false;
        $city->save();

        return redirect()->route("cities.index")->with("success", "City edited");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = Cities::findOrFail($id);
        $city->delete();

        return redirect()->route("cities.index")->with("success", "City deleted successfully");
    }
}
