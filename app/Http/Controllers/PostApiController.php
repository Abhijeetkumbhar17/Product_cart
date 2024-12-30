<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostApiController extends Controller
{
    
    public function index()
    {
        //
        $posts=Post::all();
        // return view('index')->with('posts',$posts);
        return response()->json([
            'status' => true,
            'message' => 'Posts retrieved successfully',
            'data' => $posts
        ], 200);
        
    }

   
    public function create()
    {
        //
    }

   

   
    public function store(Request $request)
{
    
    $responseData = [
        'status' => 'success',
        'message' => 'Product successfully created and images uploaded.',
        'data' => []
    ];

    if ($request->hasFile("cover")) {
        $file = $request->file("cover");
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path("cover/"), $imageName);

        $post = new Post([
            "name" => $request->name,
            "price" => $request->price,
            "cover" => $imageName,
        ]);
        $post->save();

        $responseData['data']['post'] = [
            'id' => $post->id,
            'name' => $post->name,
            'price' => $post->price,
            'cover' => $imageName,
        ];
    }

    if ($request->hasFile("images")) {
        $files = $request->file("images");
        $responseData['data']['images'] = [];

        foreach ($files as $file) {
            $imageName = time() . '_' . $file->getClientOriginalName();
            $request['post_id'] = $post->id;
            $request['image'] = $imageName;
            $file->move(public_path("/images"), $imageName);
            $image = Image::create($request->all());

            $responseData['data']['images'][] = [
                'id' => $image->id,
                'post_id' => $image->post_id,
                'image' => $imageName,
            ];
        }
    }

    return response()->json($responseData);
}

    
   
    public function edit(string $id)
    {
        //
        $posts=Post::findOrFail($id);
        //return view('edit')->with('posts',$posts);
        return response()->json([
            'status' => true,
            'message' => 'Customer found successfully',
            'data' => $posts
        ], 200);
    }

   
    public function update(Request $request, string $id)
    {
    
        $responseData = [
            'status' => 'success',
            'message' => 'Product successfully Updated.',
            'data' => []
        ];
        $post=Post::findOrFail($id);
        if ($request->hasFile("cover")) {
            $file = $request->file("cover");
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path("cover/"), $imageName);
    
            $post->update([
                "name" =>$request->name,
                "price"=>$request->price,
                "cover"=>$post->cover,
            ]);
    
            $responseData['data']['post'] = [
                'id' => $post->id,
                'name' => $post->name,
                'price' => $post->price,
                'cover' => $imageName,
            ];
        }
    
        if ($request->hasFile("images")) {
            $files = $request->file("images");
            $responseData['data']['images'] = [];
    
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $request['post_id'] = $post->id;
                $request['image'] = $imageName;
                $file->move(public_path("/images"), $imageName);
                $image = Image::create($request->all());
    
                $responseData['data']['images'][] = [
                    'id' => $image->id,
                    'post_id' => $image->post_id,
                    'image' => $imageName,
                ];
            }
        }
    
        return response()->json($responseData);
    }



    public function destroy($id)
    {
         $posts=Post::findOrFail($id);

         if (File::exists("cover/".$posts->cover)) {
             File::delete("cover/".$posts->cover);
         }
         $images=Image::where("post_id",$posts->id)->get();
         foreach($images as $image){
         if (File::exists("images/".$image->image)) {
            File::delete("images/".$image->image);
        }
         }
         $posts->delete();
         return response()->json([
            'status' => true,
            'message' => 'Post deleted successfully',

        ], 200);


    }
   

   
}
