<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;
use App\Http\Resources\SurveyResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $surveys = $user->surveys;
        return SurveyResource::collection($surveys);
    }

    public function store(StoreSurveyRequest $request)
    {
        $user = Auth::user();
        $survey = $user->surveys()->create($request->validated());
        return new SurveyResource($survey);
    }

    public function show(Survey $survey)
    {
        $this->authorize('view', $survey);
        return new SurveyResource($survey);
    }

    public function update(UpdateSurveyRequest $request, Survey $survey)
    {
        $this->authorize('update', $survey);
        $survey->update($request->validated());
        return new SurveyResource($survey);
    }

    public function destroy(Survey $survey)
    {
        $this->authorize('delete', $survey);
        $survey->delete();
        return response()->noContent();
    }
}
