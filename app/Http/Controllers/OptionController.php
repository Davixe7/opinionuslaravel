<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Survey;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Http\Resources\OptionResource;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index(Survey $survey)
    {
        return OptionResource::collection($survey->options);
    }

    public function store(StoreOptionRequest $request, Survey $survey)
    {
        $option = $survey->options()->create($request->validated());
        $option->addMediaFromRequest('image')->toMediaCollection('images');
        return new OptionResource($option);
    }

    public function show(Survey $survey, Option $option)
    {
        return new OptionResource($option);
    }

    public function update(UpdateOptionRequest $request, Survey $survey, Option $option)
    {
        $option->update($request->validated());
        if ($request->hasFile('image')) {
            $option->clearMediaCollection('images');
            $option->addMediaFromRequest('image')->toMediaCollection('images');
        }
        return new OptionResource($option);
    }

    public function destroy(Survey $survey, Option $option)
    {
        $option->delete();
        return response()->noContent();
    }
}
