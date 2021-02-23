<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>{{ config('label.title')}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  @include('partials.navigation')
  <body>
  <h1 style="margin-bottom:30px;">新規登録</h1>

<!-- form -->
<form method="post" action="/store" enctype="multipart/form-data">

    <!-- input type="text" string -->
     <div class="form-group @if(!empty($errors->first('name'))) has-error @endif">
        <label>名前</label>
        <input type="text" name="name" value="{{Input::old('name')}}" class="form-control">
        <span class="help-block">{{$errors->first('name')}}</span>
    </div>

    <!-- input type="text" string confirm -->
     <div class="form-group @if(!empty($errors->first('email'))) has-error @endif">
        <label>E-Mail</label>
        <input type="text" name="email" value="{{Input::old('email')}}" class="form-control">
        <span class="help-block">{{$errors->first('email')}}</span>
    </div>

    <div class="form-group @if(!empty($errors->first('email_confirmation'))) has-error @endif">
        <label>E-Mail（再入力）</label>
        <input type="text" name="email_confirmation" value="{{Input::old('email_confirmation')}}" class="form-control">
        <span class="help-block">{{$errors->first('email_confirmation')}}</span>
    </div>

    <!-- input type="text" int -->
     <div class="form-group @if(!empty($errors->first('age'))) has-error @endif">
        <label>年齢</label>
        <input type="text" name="age" value="{{Input::old('age')}}" class="form-control">
        <span class="help-block">{{$errors->first('age')}}</span>
    </div>

    <!-- select -->
     <div class="form-group @if(!empty($errors->first('area'))) has-error @endif">
        <label>エリア</label>
        <select name="area" class="form-control">
            <option value="">選択して下さい</option>
            <option value="option1" @if(Input::old('area')=="option1") selected @endif>オプション１</option>
            <option value="option2" @if(Input::old('area')=="option2") selected @endif>オプション２</option>
        </select>
        <span class="help-block">{{$errors->first('area')}}</span>
    </div>

    <!-- radio -->
    <p><b>性別</b></p>
    <div class="radio-inline">
        <label>
            <input type="radio" name="gender" value="man" @if(Input::old('gender')=="man") checked @endif> 男
        </label>
    </div>
    <div class="radio-inline">
        <label>
            <input type="radio" name="gender" value="woman" @if(Input::old('gender')=="woman") checked @endif> 女
        </label>
    </div>
     <div class="form-group @if(!empty($errors->first('gender'))) has-error @endif">
        <span class="help-block">{{$errors->first('gender')}}</span>
    </div>

    <!-- checkbox -->
    <p><b>告知メディア</b></p>
    <div class="checkbox">
        <label>
            {{-- <input type="hidden" name="media1" value="none"> --}}
            <input type="checkbox" name="media1" value="web" @if(Input::old('media1')=="web") checked @endif> Web
        </label>
    </div>
     <div class="form-group @if(!empty($errors->first('media1'))) has-error @endif">
        <span class="help-block">{{$errors->first('media1')}}</span>
    </div>

    <div class="checkbox">
        <label>
            {{-- <input type="hidden" name="media2" value="none"> --}}
            <input type="checkbox" name="media2" value="TV" @if(Input::old('media2')=="TV") checked @endif> TV
        </label>
    </div>
     <div class="form-group @if(!empty($errors->first('media2'))) has-error @endif">
        <span class="help-block">{{$errors->first('media2')}}</span>
    </div>


    <!-- textarea -->
     <div class="form-group @if(!empty($errors->first('note'))) has-error @endif">
        <label>感想</label>
        <textarea name="note" class="form-control" rows="3">{{Input::old('note')}}</textarea>
        <span class="help-block">{{$errors->first('note')}}</span>
    </div>

    <!-- file -->
     <div class="form-group @if(!empty($errors->first('image'))) has-error @endif">
        <label>画像</label>
        <input type="file" name="image">
        <span class="help-block">{{$errors->first('image')}}</span>
    </div>

    <!-- token -->
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <input type="submit" value="登録" class="btn btn-primary">

</form>

  </body>
</html>