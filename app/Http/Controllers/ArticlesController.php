<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Article;
use App\Services\ArticleService;
use App\Services\TagService;

/**
 * 記事クラス
 * 
 */
class ArticlesController extends Controller
{
    /** 記事 サービス */
    private $articleService = null;

    /** タグ サービス */
    private $tagService = null;

    /**
     * コンストラクタ
     *
     * @return void
     */
    public function __construct(ArticleService $articleService, TagService $tagService)
    {
        // プロパティへサービスを設定する
        // [メモ] プロパティへのアクセスは$は不要だから注意
        $this->articleService = $articleService;
        $this->tagService = $tagService;

        // Authの設定を行う
        //$this->middleware('auth', ['except' => ['show']]);
        //$this->middleware('auth', ['except' => ['index', 'show']]);
        
    }

    /**
     * 一覧画面遷移アクション
     *
     * @return
     */
    public function index(){
        // 記事サービスからログインユーザに紐付く記事一覧を取得する
        $articles = $this->articleService->getArticles();
        // [メモ] APPファサードでもアクセス可能だが依存関係を持ってしまうのでNG(サービスプロバイダーで持つべき)
        //$articles = \App::make(App\Services\Articles\Articles::class)->getArticles();

        // 画面描画を行う
        // [メモ] compactで合致する変数名を配列化する。
        return view('articles.index',  compact('articles'));
        // [サンプル] withでパラメータを付与する事も可
        //return view('articles.index')->with('articles', $articles);
        // [サンプル] 4.x系では以下の記述文法となる※5.xでも動作可能
        //return \View::make('articles.index',  compact('articles'));
    }

    /**
     * 詳細画面遷移アクション
     * 
     * @return
     */
    public function show(Article $article){
    // [メモ] 暗黙でモデル結合ルート(idと紐付くmodelを取得)する。コントローラ内で取得する場合はURLパラメータの$idを取得する事も可
    //public function show($id){
        //$article = Article::findOrFail($id);

        // 画面描画を行う
        return view('articles.detail', compact('article'));
    }

    /**
     * 登録画面遷移アクション
     * 
     * @return
     */
    public function create(){
        // タグサービスから全タグを取得する
        $tags = $this->tagService->getTags();

        // 画面描画を行う
        return view('articles.create', compact('tags'));
    }

    /**
     * 登録アクション
     * 
     * @param type $name Description
     * @return type Description
     */
    public function store(ArticleRequest $request){
    // [メモ]リクエストクラスを拡張して設定すればバリデーションをそちらに譲渡できる。コントローラで行う場合は以下の通り。
    //public function store(Request $request){
    //    // バリデーションのルールを定義
    //    $rules = [
    //        'title' => 'required|min:3',
    //        'body' => 'required',
    //    ];
    //   // バリデーションの実行
    //   $this->validate($request, $rules);

        // Authで認証済なユーザModelを返却する
        // [メモ] \マークを付与するとグローバル空間として動作する(\マークを付けない場合、同じ階層空間として処理される)
        // [メモ] createファンクションを行う場合、modelに設定可能なフィールド名を設定する必要がある(複数代入)(https://readouble.com/laravel/5.3/ja/eloquent.html#mass-assignment)saveの場合は内部で記載するので不要
        $article = \Auth::user()->articles()->create($request->all());
        // 関連テーブルのタグ関連テーブルも併せて登録する
        $article->tags()->attach($request->input('tag_list'));       
        // [メモ] saveの場合
        //$article = new Article();
        //$article->title = $request->title;
        //$article->body  = $request->body;
        //$article->save();

        // 一覧画面にリダイレクト(URLの変更に対応する為、ルート名でマッピングさせる)
        return redirect()->route('articles.index')->with('flash_message','New Article Added !');
        //return redirect('/')->with('flash_message','New Article Added !');
    }

    /**
     * 編集画面遷移アクション
     * 
     * @param type $name Description
     */
    public function edit(Article $article){
        // タグサービスから全タグを取得する
        $tags = $this->tagService->getTags();

        // 画面描画を行う
        return view('articles.edit', compact($article, $tags));
    }

    /*
     * 編集アクション
     */
    public function update(Article $article, ArticleRequest $request){
        //
        $article->update($request->all());
        $article->tags()->sync($request->input('tag_list', []));

        // 画面描画を行う
        // [メモ] リクエストスコープのフラッシュメッセージを設定する(次画面で消える)
        \Session::flash('flash_message', '記事を更新しました。');
        return redirect()->route('articles.show', ['id' => $article->id]);
    }

    /**
     * 削除アクション
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        // TODO:なんでsessionの前に\が必要？なかったらnotFoundになった…
        \Session::flash('flash_message', '記事を削除しました。');
        return redirect()->route('articles.index');
        //return redirect('/')->with('flash_message','Article deleted.');
    }

}
