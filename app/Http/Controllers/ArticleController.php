<?php

namespace App\Http\Controllers;

use App\Libraries\Utilities;
use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class ArticleController extends Controller
{
    //fetch all articles
    public function index(){
    	$articles = Article::paginate(10); //10 articles per page
        return response()->json([
            'data' => $articles
        ]);
    }

    //fetch an article
    public function show($id){
   		$article = Article::find($id);
   		if($article){
   			return response()->json(['data' => $article]);
   		}else{
   			return response()->json(['error' => 'Article not found'], 400);
   		}
    }

    //rate an article
    public function rating(Request $request, $id){
        //check if id exists
        $article = Article::find($id);
        if(isset($article)){
            //exists
            //validate field
            $validator = Validator::make($request->all(), [
                'rating' => 'required|integer|between:1,10'
            ]);
            if($validator->fails()){
                return response()->json(['error'=>$validator->errors()], 401);
            }
            //update
            Article::rating($id, $request->rating);
            return response()->json(['message' => 'Rating has been updated'], 200);
        }else{
            return response()->json(['error' => 'Article not found'], 400);
        }
    }

    //search for article(s)
    public function search($query){
        $article = Article::where('title', 'like', '%'.$query.'%')->paginate(10); //search by title
        if($article->count() > 0){
            return response()->json(['data' => $article],  200);
        }else{
            return response()->json(['error' => 'No article was found'], 400);
        }
    }

    //create article
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $article = Article::create([
            'title' => $request->title,
            'body' => $request->body
        ]);
        if ($article)
            return response()->json([
                'data' => $article->toArray()
            ], 201);
        else{
            return response()->json([
                'message' => 'Article could not be added'
            ], 500);
        }
    }

    //update article
    public function update(Request $request, $id){
        //check if exists
        $article = Article::find($id);
        if($article){
            //exists
            $update = $article->fill($request->all())->save();
            if($update){
                return response()->json([
                    'message' => 'Article updated'
                ]);
            }else{
                return response()->json([
                    'message' => 'Article could not be updated'
                ], 500);
            }
        }else{
            //
            return response()->json([
                'message' => 'Article not found'
            ], 400);
        }
    }

    //delete an article
    public function delete($id){
        $article = Article::find($id);
        if($article){
            //exists
            $delete = $article->delete();
            if($delete){
                return response()->json([
                    'message' => 'Article deleted'
                ]);
            }else{
                return response()->json([
                    'message' => 'Article could not be deleted'
                ], 500);
            }
        }else{
            //
            return response()->json([
                'message' => 'Article not found'
            ], 400);
        }
    }
}
