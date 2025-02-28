<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Http\Requests\UpdateVoteRequest;
use App\Http\Requests\StoreVoteRequest;
use App\Http\Resources\VoteResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index(Survey $survey)
    {
        //$votes = $survey->votes;

        $votes = Vote::all();
        return VoteResource::collection($votes);
    }

    public function store(StoreVoteRequest $request, Survey $survey)
    {
        //$user = Auth::user();

        // $vote = Vote::create([
        //     'survey_id' => $survey->id,
        //     'option_id' => $request->option_id,
        //     'user_id' => $user->id,
        // ]);

        $vote = Vote::create($request->validated());
        return new VoteResource($vote);
    }

    public function show(Survey $survey, Vote $vote)
    {
        return new VoteResource($vote);
    }

    public function update(UpdateVoteRequest $request, Survey $survey, Vote $vote)
    {
        $vote->update($request->validated());
        return new VoteResource($vote);
    }

    public function destroy(Survey $survey, Vote $vote)
    {
        $vote->delete();
        return response()->noContent();
    }
}
