<?php

namespace App\Services;

class ArticleService 
{

    public function getArticles() {
        // ログインユーザに紐付く記事一覧を取得する
        // [メモ] 取得処理(published部分はmodelに定義したスコープ定義を使用)
        $articles = \Auth::user()->articles()->published()->get();
        // [サンプル] ログインユーザに紐付いていない取得
        //$articles = Article::latest('created_at')->published()->get();
        //$articles = Article::all();
        // [メモ] 以下はファサードでアクセス(サービスコンテナ※Javaで言うところのDIコンテナ)していないのでDB情報等がなくエラーになる
        //$tmp = new Article();
        //$articles = $tmp.all();

        return $articles;
    }


}
