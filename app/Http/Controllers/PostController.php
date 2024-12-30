<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Image;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    
    public function index()
    {
        //
        $posts=Post::all();
        return view('index')->with('posts',$posts);
        
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
        if($request->hasFile("cover")){
            $file=$request->file("cover");
            $imageName=time().'_'.$file->getClientOriginalName();
            $file->move(\public_path("cover/"),$imageName);

            $post =new Post([
                "name" =>$request->name,
                "price" =>$request->price,
                "cover" =>$imageName,
            ]);
           $post->save();
        }

            if($request->hasFile("images")){
                $files=$request->file("images");
                foreach($files as $file){
                    $imageName=time().'_'.$file->getClientOriginalName();
                    $request['post_id']=$post->id;
                    $request['image']=$imageName;
                    $file->move(\public_path("/images"),$imageName);
                    Image::create($request->all());

                }
            }

            return redirect("/allproduct");
    }

   
    public function show(string $id)
    {
        //
    }

   
    public function edit(string $id)
    {
        //
        $posts=Post::findOrFail($id);
        return view('edit')->with('posts',$posts);
    }

   
    public function update(Request $request, string $id)
    {
        //
        $post=Post::findOrFail($id);
        if($request->hasFile("cover")){
            if (File::exists("cover/".$post->cover)) {
                File::delete("cover/".$post->cover);
            }
            $file=$request->file("cover");
            $post->cover=time()."_".$file->getClientOriginalName();
            $file->move(\public_path("/cover"),$post->cover);
            $request['cover']=$post->cover;
        }
   
           $post->update([
               "name" =>$request->name,
               "price"=>$request->price,
               "cover"=>$post->cover,
           ]);
   
           if($request->hasFile("images")){
               $files=$request->file("images");
               foreach($files as $file){
                   $imageName=time().'_'.$file->getClientOriginalName();
                   $request["post_id"]=$id;
                   $request["image"]=$imageName;
                   $file->move(\public_path("images"),$imageName);
                   Image::create($request->all());
   
               }
           }
   
           return redirect("/allproduct");
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
         return back();


    }

    public function deleteimage($id){
        $images=Image::findOrFail($id);
        if (File::exists("images/".$images->image)) {
           File::delete("images/".$images->image);
       }

       Image::find($id)->delete();
       return back();
   }

   public function deletecover($id){
    $cover=Post::findOrFail($id)->cover;
    if (File::exists("cover/".$cover)) {
       File::delete("cover/".$cover);
   }
   return back();
}
}
