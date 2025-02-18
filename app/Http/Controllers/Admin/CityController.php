<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Image;
use App\Models\Article;
use App\Services\UploadService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityFormRequest;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::simplePaginate(10);
        return view('admin.cities.index', ['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.newCity');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CityFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityFormRequest $request)
    {
        $validated = $request->validated();
        $created = City::create($validated);

        if ($created) {
            $article = Article::create([
                'article_body' => app(UploadService::class)->saveText(
                    $request->input('article'),
                    'articles',
                )
            ]);
            $created->articles()->attach($article);

            if ($validated['images']) {
                foreach ($validated['images'] as $image) {
                    $image = Image::create([
                        'name' => 'storage/' . app(UploadService::class)->saveFile($image, 'images')
                    ]);
                    $created->images()->attach($image);
                }
            }

            return to_route('admin.cities.index');
        }

        return back()->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param City $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return view('admin.cities.newCity', [
            'city' => $city,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CityFormRequest $request
     * @param City $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityFormRequest $request, City $city)
    {
        $city->update($request->validated());
        return to_route('admin.cities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param City $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        try {
            $city->delete();
            return response()->json('ok');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('City error destroy', [$e]);
            return response()->json('error', 400);
        }
    }
}
