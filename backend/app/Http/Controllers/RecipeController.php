<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RecipeController extends Controller
{
    ## get all recipes and fiter the recipes by category

    public function index(){
        try{
            // dd(request(['category']));
            return Recipe::filter(request(['category'])
            )->paginate(6);
            
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

            if($validator->fails()){
            ## $flatteredError change the error massage from this "title": [ "The title field is required. "] to that  "title": "The title field is required."

                $flatteredErrors = collect($validator->errors())->flatMap(function($e, $field) {
                    return [$field => $e[0]];
                });

                return response()->json([
                    'error' => $flatteredErrors,
                    'status' => 400
                ],400);
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

    public function update($id){

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
                'image' => 'required',
                'category_id' => ['required', Rule::exists('categories','id')],
            ]);

            if($validator->fails()){
            ## $flatteredError change the error massage from this "title": [ "The title field is required. "] to that  "title": "The title field is required."

                $flatteredErrors = collect($validator->errors())->flatMap(function($e, $field) {
                    return [$field => $e[0]];
                });

                return response()->json([
                    'error' => $flatteredErrors,
                    'status' => 400
                ],400);
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
                'image' => ['required', 'image']
            ]);
    
            if($validator->fails()){
                ## $flatteredError change the error massage from this "title": [ "The title field is required. "] to that  "title": "The title field is required."
    
                    $flatteredErrors = collect($validator->errors())->flatMap(function($e, $field) {
                        return [$field => $e[0]];
                    });
    
                    return response()->json([
                        'error' => $flatteredErrors,
                        'status' => 400
                    ],400);
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
        //   dd("destroy function is working!");
        $recipe = Recipe::find($id);
        if(!$recipe){
            return response()->json([
                'message' => "recipe not fond",
                'status' => 404
            ],404);
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
