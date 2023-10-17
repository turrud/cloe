<?php

namespace App\Http\Controllers;

use App\Models\Lms;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allLms = Lms::latest()->paginate(5);

        return view('index', compact('allLms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('load');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validated = $request->validated();
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $lms = Lms::create($validated);

        return redirect()
            ->route('all-lms.edit', $lms)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}