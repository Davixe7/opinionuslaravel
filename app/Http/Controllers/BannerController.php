<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Survey;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Http\Resources\BannerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    // public function index()
    // {   
    //     $user = Auth::user();
    //     $surveys = $user->surveys()->with('banner')->get();

    //     $banners = $surveys->map(function ($survey) {
    //         return $survey->banner;
    //     })->filter();

    //     return BannerResource::collection($banners);
    // }

    public function index()
    {
        $banners = Banner::all();
        return BannerResource::collection($banners);
    }

    public function store(StoreBannerRequest $request, Survey $survey)
    {
        $banner = $survey->banner()->create($request->validated());

        if ($request->hasFile('banner')) {
            $banner->addMediaFromRequest('banner')->toMediaCollection('banners');
        }

        return new BannerResource($banner);
    }

    public function show(Survey $survey, Banner $banner)
    {
        return new BannerResource($banner);
    }

    public function update(UpdateBannerRequest $request, Survey $survey, Banner $banner)
    {
        $banner->update($request->validated());

        if ($request->hasFile('banner')) {
            $banner->clearMediaCollection('banners');
            $banner->addMediaFromRequest('banner')->toMediaCollection('banners');
        }
        
        return new BannerResource($banner);
    }

    public function destroy(Survey $survey, Banner $banner)
    {
        $banner->delete();
        return response()->noContent();
    }
}
