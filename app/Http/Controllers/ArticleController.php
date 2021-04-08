<?php
namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        if (request()->has('keyWord')) {
            $keyWord = request()->input('keyWord');
            if (request()->input('myArticle') == true) {
                $articles = auth()->user()->articles()
                    ->where('title', 'like', '%' . $keyWord . '%')
                    ->get();
            } else {
                $articles = Article::where('title', 'like', '%' . $keyWord . '%')
                    ->get();
            }
            return view('articles', ['articles' => $articles]);
        } else {
            $articles = request()->has('myArticle') ? auth()->user()->articles : Article::all();
            return view('articles', ['articles' => $articles]);
        }
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        $article = $user->articles()->create($request->only(['title', 'content']));
        return redirect('article');
    }

    public function edit($id)
    {
        $article = Article::find($id);
        return view('edit', ['article' => $article]);
    }

    public function update(Request $request)
    {
        $article = Article::find($request->route('id'));
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->push();
        return redirect('article');
    }

    public function remove($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect('article');
    }

    public function read($id)
    {
        $article = Article::find($id);
        return view('read', [
            'id' => request()->input('article_id'),
            'comments' => $article->comments,
            'article' => $article,
        ]);
    }
}
