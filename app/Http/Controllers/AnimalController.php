<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnimalRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Animal;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Animals/Index', [
            'animals' => Auth::user()->animals()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Animals/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAnimalRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAnimalRequest $request)
    {
        $animal = new Animal();
        $animal->fill($request->all());
        $animal->user_id = Auth::user()->id;
        $animal->save();

        return redirect()->route('animals.index');
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
     * @param Animal $animal
     * @return \Inertia\Response
     */
    public function edit(Animal $animal)
    {
        return Inertia::render('Animals/Edit', [
            'animal' => $animal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreAnimalRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreAnimalRequest $request, $id)
    {
        Animal::find($id)->update($request->all());
        return redirect()->route('animals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Animal::find($id)->delete();
        return redirect()->route('animals.index');
    }
}
