<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagStoreMovieRequest;
use App\Http\Requests\TagStoreRequest;
use App\Http\Resources\TagResource;
use App\Models\Movie;

class TagController extends Controller
{
    /**
     * @param TagStoreRequest $request
     * @return TagResource
     */
    public function store(TagStoreRequest $request): TagResource
    {
        $tag = Tag::create([
            "name" => $request->name,
        ]);

        return TagResource::make($tag);
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $tag = Tag::findOrFail($id);

        $tag->delete($tag);
    }
}
