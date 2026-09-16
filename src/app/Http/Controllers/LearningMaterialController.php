<?php

namespace App\Http\Controllers;

use App\Models\LearningMaterial;
use App\Models\Skills;
use Illuminate\Http\Request;

class LearningMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LearningMaterial $learningMaterial)
    {
        //
    }

    public function getFlashCard(int $skillId) {
        $skill = Skills::where('id', $skillId)
            ->with('topic.domain.subject')
            ->first();

        $flashCard = LearningMaterial::where('material_type', 'flash_card')
            ->where('skill_id', $skillId)->inRandomOrder()->first();

        if (!$flashCard) {
            return view('errors.404');
        }

        return view('flashcard', compact('skill','flashCard'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LearningMaterial $learningMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LearningMaterial $learningMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LearningMaterial $learningMaterial)
    {
        //
    }
}
