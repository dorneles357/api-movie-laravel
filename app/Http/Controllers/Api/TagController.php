<?php
 
namespace App\Http\Controllers\Api;

use App\Models\Tag;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function store(Request $request, $id)
    {
        $tag = Tag::create([
            "name"=> $request->name,
        ]);
        
        $res_id = $tag->id;

        $movie = Movie::find($id);

        $movie->tags()->attach($res_id);

        return response()->json(["status"=>"create"]);
    }
    
    public function destroy($id)
    {
        $tag = Tag::find($id);

        $tag->delete($tag);

        return response()->json(['status'=>'deleted']);
    }



}