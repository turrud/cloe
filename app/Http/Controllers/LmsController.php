<?php

namespace App\Http\Controllers;

use App\Models\Lms;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LmsStoreRequest;
use App\Http\Requests\LmsUpdateRequest;
use Illuminate\Support\Facades\Storage;

class LmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Lms::class);

        $search = $request->get('search', '');

        $allLms = Lms::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.all_lms.index', compact('allLms', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Lms::class);

        return view('app.all_lms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LmsStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Lms::class);

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
    public function show(Request $request, Lms $lms): View
    {
        $this->authorize('view', $lms);

        return view('app.all_lms.show', compact('lms'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Lms $lms): View
    {
        $this->authorize('update', $lms);

        return view('app.all_lms.edit', compact('lms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        LmsUpdateRequest $request,
        Lms $lms
    ): RedirectResponse {
        $this->authorize('update', $lms);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            if ($lms->file) {
                Storage::delete($lms->file);
            }

            $validated['file'] = $request->file('file')->store('public');
        }

        if ($request->hasFile('image')) {
            if ($lms->image) {
                Storage::delete($lms->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $lms->update($validated);

        return redirect()
            ->route('all-lms.edit', $lms)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Lms $lms): RedirectResponse
    {
        $this->authorize('delete', $lms);

        if ($lms->file) {
            Storage::delete($lms->file);
        }

        if ($lms->image) {
            Storage::delete($lms->image);
        }

        $lms->delete();

        return redirect()
            ->route('all-lms.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
