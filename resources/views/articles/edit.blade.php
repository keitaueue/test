<!DOCTYPE html>
<h1>Article Edit Form</h1>
<hr>ab

@include('articles.form_error')

{!! Form::model($article, ['action' => ['ArticlesController@update', $article->id]]) !!}
    {{ method_field('patch') }}
    @include('articles.form', ['submitButton' => 'EDIT'])
{!! Form::close() !!}
{!! link_to($article->id, $title = '戻る', $attributes = array('a', 'b'), $secure = null) !!}
