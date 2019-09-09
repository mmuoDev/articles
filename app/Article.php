<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = ['title', 'body', 'rating'];

    //update article rating
    public static function rating($article_id, $rating){
        $article = Article::where('id', $article_id)
                        ->update(['rating' => $rating]);
        return $article;
    }

}
