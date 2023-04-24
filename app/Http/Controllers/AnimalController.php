<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAnimalRequest;
use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
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
            'animals' => Auth::user()
                ->animals()
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
     * @param Animal $animal
     */
    public function show(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserAnimalRequest $request
     * @param Animal $animal
     * @return \Inertia\Response
     */
    public function edit(UserAnimalRequest $request, Animal $animal)
    {
        return Inertia::render('Animals/Edit', [
            'animal' => $animal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAnimalRequest $request
     * @param Animal $animal
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAnimalRequest $request, Animal $animal)
    {
        $animal->update($request->all());
        return redirect()->route('animals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserAnimalRequest $request
     * @param Animal $animal
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(UserAnimalRequest $request, Animal $animal)
    {
        $animal->delete();
        return redirect()->route('animals.index');
    }
}
