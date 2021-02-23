<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>{{ config('label.title')}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  @include('partials.navigation')
  <body>
    <div class="jumbotron">
      <h1 class="display-4">Hello, world!</h1>
      <p class="lead">This is a simple hero unit ...</p>
      <hr class="my-4">
      <p>It uses utility classes for ...</p>
    </div>
  </body>
</html>