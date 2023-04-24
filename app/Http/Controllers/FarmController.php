<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFarmRequest;
use App\Http\Requests\StoreFarmRequest;
use App\Http\Requests\UpdateFarmRequest;
use App\Models\Farm;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Farms/Index', [
            'farms' => Auth::user()
                ->farms()
                ->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Farms/Create', [
            'animals' => Auth::user()
                ->animals()
                ->whereNull('farm_id')
                ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFarmRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreFarmRequest $request)
    {
        $farm = new Farm();
        $farm->fill($request->all());
        $farm->user_id = Auth::user()->id;
        $farm->save();

        Auth::user()
            ->animals()
            ->whereIn('id', $request->get('animals'))
            ->update(['farm_id' => $farm->id]);

        return redirect()->route('farms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Farm $farm
     */
    public function show(Farm $farm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserFarmRequest $request
     * @param Farm $farm
     * @return \Inertia\Response
     */
    public function edit(UserFarmRequest $request, Farm $farm)
    {
        return Inertia::render('Farms/Edit', [
            'farm' => $farm,
            'selectedAnimals' => $farm
                ->animals()
                ->get()
                ->pluck('id'),
            'animals' => Auth::user()
                ->animals()
                ->whereNull('farm_id')
                ->orWhere('farm_id', $farm->id)
                ->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFarmRequest $request
     * @param Farm $farm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateFarmRequest $request, Farm $farm)
    {
        $farm->update($request->all());
        return redirect()->route('farms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserFarmRequest $request
     * @param Farm $farm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(UserFarmRequest $request, Farm $farm)
    {
        Auth::user()
            ->animals()
            ->find($farm->id)
            ->update(['farm_id' => NULL]);
        $farm->delete();
        return redirect()->route('farms.index');
    }
}
