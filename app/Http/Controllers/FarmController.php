<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFarmRequest;
use App\Models\Farm;
use Illuminate\Http\Request;
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
        return Inertia::render('Farms/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(StoreFarmRequest $request)
    {
        $farm = new Farm();
        $farm->fill($request->all());
        $farm->user_id = Auth::user()->id;
        $farm->save();

        return redirect()->route('farms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Farm $farm
     * @return \Inertia\Response
     */
    public function edit(Farm $farm)
    {
        return Inertia::render('Farms/Edit', [
            'farm' => $farm
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreFarmRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreFarmRequest $request, $id)
    {
        Farm::find($id)->update($request->all());
        return redirect()->route('farms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Farm::find($id)->delete();
        return redirect()->route('farms.index');
    }
}
