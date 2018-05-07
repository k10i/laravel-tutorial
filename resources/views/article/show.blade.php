@extends('layout')

@section('content')
    <h1>ブログ詳細</h1>

    <form method="post" action="/delete">
      {{ csrf_field() }}
      <input type="hidden" class="form-control" name="id" value="{{ $article->id }}">
      <div class="form-group">
        <label for="titleInput">タイトル</label>
        <div>
        {{ $article->title }}
      </div>
      </div>
      <div class="form-group">
        <label for="bodyInput">内容</label>
        <div>
        {!! nl2br(e($article->body)) !!}
      </div>
      </div>
      <button type="submit" class="btn btn-primary">削除</button>
    </form>

    <h2>コメント</h2>
    <form method="post" action="/comments">
      {{ csrf_field() }}
      <input type="hidden" class="form-control" name="article_id" value="{{ $article->id }}">

      <div class="form-group">
          <textarea name="comment" class="form-control">{{ old('comment') }}</textarea>
          @if ($errors->has('comment'))
            <span class="text-danger">{{ $errors->first('comment') }}</span>
          @endif

      </div>

      <div class="form-group">
          <input type="submit" value="コメントする" class="btn btn-primary">
      </div>
    </form>

    @foreach ($article->comments as $comment)
      <div>
        {{ $comment->comment }}
      </div>
      <hr>
    @endforeach
@endsection
