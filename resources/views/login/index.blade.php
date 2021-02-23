<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>{{ config('label.title')}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Order sys</div>
              <div class="card-body">
                <form class="form-horizontal" action="auth" method="POST">
                  {{ csrf_field() }}
                  <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <div class="col-md-6">
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email" autofocus>
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                    <div class="col-md-6">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" required autocomplete="current-password">
                      @error('password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                      @if (session('flash_message'))
                        <div class="flash_message">
                          {{ session('flash_message') }}
                        </div>
                      @endif
                      <button type="submit" class="btn btn-primary">
                          {{ __('Login') }}
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>