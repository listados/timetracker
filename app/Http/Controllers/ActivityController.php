<?php

namespace App\Http\Controllers;

use App\Services\ActivityService;
use Illuminate\Http\Request;
use function request;

class ActivityController extends Controller
{
    public function __construct(
        private readonly ActivityService $activityService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('activity.index',[
            'activity' => $this->activityService->allActivityByProject(request()->id)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'started_at' => 'nullable|date',
            'ended_at' => 'nullable|date|after_or_equal:started_at',
            'github_link' => 'nullable|url',
            'todoist_link' => 'nullable|url',
            'other_links' => 'nullable|array',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['project_id'] = $id > 0 ? $id : null;

        $this->activityService->create($validated);

        return redirect()->back()->with('success', 'Atividade criada com sucesso!');
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'started_at' => 'nullable|date',
            'ended_at' => 'nullable|date|after_or_equal:started_at',
            'github_link' => 'nullable|url',
            'todoist_link' => 'nullable|url',
            'other_links' => 'nullable|array',
        ]);

        $this->activityService->update((int) $id, $validated);

        return redirect()->back()->with('success', 'Atividade atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->activityService->delete((int) $id);

        return redirect()->back()->with('success', 'Atividade excluída com sucesso!');
    }
}
