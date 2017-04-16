<?php

namespace App\Http\Controllers;

use App\Habit;
use Illuminate\Http\Request;

class HabitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $habits = user()->habits()->withCount('days')->withCount('daysFulfilled')->get();

        return response()->json($habits);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, $this->validationRules());

        $habit = user()->habits()->save(new Habit($request->all()));

        $habit->reasons = [];

        return response()->json($habit->makeVisible('reasons'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Habit  $habit
     * @return \Illuminate\Http\Response
     */
    public function show($habitId)
    {
        $habit = user()->habits()->with('reasons')->find($habitId);

        return response()->json($habit->makeVisible('reasons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Habit  $habit
     * @return \Illuminate\Http\Response
     */
    public function edit(Habit $habit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Habit  $habit
     * @return \Illuminate\Http\Response
     */
    public function update($habitId, Request $request)
    {

        $this->validate($request, $this->validationRules());

        user()->habits()->where('id', $habitId)->update($request->all());

        return $this->ok();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Habit  $habit
     * @return \Illuminate\Http\Response
     */
    public function destroy($habitId)
    {
        user()->habits()->where('id', $habitId)->delete();

        return $this->ok();
    }

    private function validationRules() {
        return [
            'name' => 'required|min:4',
            'description' => 'required',
            'points' => 'required|integer|min:0|max:100'
        ];
    }
}
