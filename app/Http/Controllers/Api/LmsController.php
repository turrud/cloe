<?php

namespace App\Http\Controllers\Api;

use App\Models\Lms;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\LmsResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\LmsCollection;
use App\Http\Requests\LmsStoreRequest;
use App\Http\Requests\LmsUpdateRequest;
use Illuminate\Support\Facades\Storage;

class LmsController extends Controller
{
    public function index(Request $request): LmsCollection
    {
        $this->authorize('view-any', Lms::class);

        $search = $request->get('search', '');

        $allLms = Lms::search($search)
            ->latest()
            ->paginate();

        return new LmsCollection($allLms);
    }

    public function store(LmsStoreRequest $request): LmsResource
    {
        $this->authorize('create', Lms::class);

        $validated = $request->validated();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); // Dapatkan nama file asli
            $file->storeAs('public/files', $fileName);
            $validated['file'] = 'files/' . $fileName;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); // Dapatkan nama file asli
            $image->storeAs('public/images', $imageName);
            $validated['image'] = 'images/' . $imageName;
        }

        $lms = Lms::create($validated);

        return new LmsResource($lms);

    }

    public function show(Request $request, Lms $lms): LmsResource
    {
        $this->authorize('view', $lms);

        return new LmsResource($lms);
    }

    public function update(LmsUpdateRequest $request, Lms $lms): LmsResource
    {
        $this->authorize('update', $lms);

        $validated = $request->validated();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); // Dapatkan nama file asli
            $file->storeAs('public/files', $fileName);
            $validated['file'] = 'files/' . $fileName;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); // Dapatkan nama file asli
            $image->storeAs('public/images', $imageName);
            $validated['image'] = 'images/' . $imageName;
        }

        $lms->update($validated);

        return new LmsResource($lms);

    }

    public function destroy(Request $request, Lms $lms): Response
    {
        $this->authorize('delete', $lms);

        if ($lms->file) {
            Storage::delete($lms->file);
        }

        if ($lms->image) {
            Storage::delete($lms->image);
        }

        $lms->delete();

        return response()->noContent();
    }
}