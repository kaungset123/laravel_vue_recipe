<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Responses\ValidationErrorResponse;

class RecipeController extends Controller
{
    ## get all recipes and fiter the recipes by category

    public function index(){
        try{
            return Recipe::filter(request(['category'])
            )->with('category:id,name')->orderBy('created_at','desc')->paginate(6);
            
        }catch(Exception $e){
            return response()->json([
                'message' => "error",
                'status' => 500
            ],500);
        }
    }

    ## POST - / api/recipes
    ## Status 400  ->  Bad Request
    public function store(){
        try{
            $validator = Validator::make(request()->all(),[
                'title' => 'required',
                'description' => 'required',
                'image' => 'required',
                'category_id' => ['required', Rule::exists('categories','id')],
            ]);

            if ($validator->fails()) {
                return new ValidationErrorResponse($validator);
            }

            $recipe  = new Recipe();
            $recipe->title = request('title');
            $recipe->description = request('description');
            $recipe->image = request('image');
            $recipe->category_id = request('category_id');
            $recipe->save();

            return response()->json($recipe, 201);
        }catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ],500);
        }
    }

    public function update(Request $request,$id){
    
        try{
            $recipe = Recipe::find($id);

            if(!$recipe){
                return response()->json([
                    'message' => "recipe not fond",
                    'status' => 404
                ],404);
            }

            $validator = Validator::make(request()->all(),[
                'title' => 'required',
                'description' => 'required',
                'image' => 'nullable',
                'category_id' => ['required', Rule::exists('categories','id')],
            ]);            

            if ($validator->fails()) {
                return new ValidationErrorResponse($validator);
            }

            $recipe->title = request('title');
            $recipe->description = request('description');
            $recipe->image = request('image');
            $recipe->category_id = request('category_id');
            $recipe->save();


            return response()->json($recipe, 201);
        }catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ],500);
        }
    }

    public function show($id){
        try{
            $recipe = Recipe::find($id);
            if(!$recipe){
                return response()->json([
                    'message' => "recipe not fond",
                    'status' => 404
                ],404);
            }
            return $recipe;
            
        }catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ],500);
        }
    }

    ## upload image api
    ## POST - /api/recipes/upload 

    public function upload(){
       
        try{            
            $validator = Validator::make(request()->all(),[
                'image' => 'nullable'
            ]);
            
            if ($validator->fails()) {
                return new ValidationErrorResponse($validator);
            }
    
           $path = '/storage/' . request('image')->store('/recipes');

           return [
            'path' => $path,
            'status' => 200
           ];
           
        }catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ],500);
        }

    }

    public function destroy($id){
        try{
        $recipe = Recipe::find($id);
        $img = $recipe->image;

        $filename = substr($img, strrpos($img, '/') + 1);

        if(!$recipe){
            return response()->json([
                'message' => "recipe not fond",
                'status' => 404
            ],404);
        }

        if(!empty($filename)){
            $img_path = public_path('storage/recipes/' . $filename);
            if(file_exists($img_path)){
                unlink($img_path);
            }                
        }

        $recipe->delete();
        return $recipe;
        }catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ],500);
        }
    }
}
