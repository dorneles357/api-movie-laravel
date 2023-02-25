<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieAssignTagsRequest;
use App\Http\Resources\MovieResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;



class MovieController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $asc = $request->input('asc');
        $desc = $request->input('desc');

        if (!$asc && !$desc) {
            $movies = Movie::all();
        }

        if ($asc) {
            $movies = Movie::orderBy('name', 'asc')->get();
        }

        if ($desc) {
            $movies = Movie::orderBy('name', 'desc')->get();
        }

        return MovieResource::collection($movies);
    }

    /**
     * @param int $id
     * @return MovieResource
     */
    public function show(int $id): MovieResource
    {
        $movie = Movie::findOrFail($id);

        return MovieResource::make($movie);
    }

    public function store(Request $request)
    {
        if ($request->hasfile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $path = $file->store('movies');
            $size = $file->getSize() / 1000;
            $type = $file->getMimeType();
        } else {
            return response()->json(['error' => 'Arquivo inválido']);
        }

        $string = explode('/', $type);

        if ($string[0] == 'video' && $size < 625000) {

            Movie::create([
                "name" => $request->name,
                "path" => $path,
                'type' => $type,
                'size' => $size,
            ]);


            return response()->json(['message' => 'created']);
        } else {
            return response()->json(['error' => 'Apenas Videos menores 5mb']);
        }
    }

    public function update(Request $request, $id)
    {

        $validator = validator()->make(request()->all(), [
            'name' => 'string|required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Name cannot be empty']);
        }
        $data = [
            "name" => $request->name,
        ];

        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['message' => 'File not found']);
        }


        $update_movie = $movie->update($data);

        return response()->json(['status' => 'update']);
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['message' => 'File not found']);
        }

        foreach ($movie->tags as $tag) {
            $movie->tags()->detach($tag->id);
        }
        Storage::delete($movie->path);

        $movie->delete($movie);

        return response()->json(['status' => 'deleted']);
    }

    public function assignTags(MovieAssignTagsRequest $request)
    {
        return response('', 404)->json();
    }
}
