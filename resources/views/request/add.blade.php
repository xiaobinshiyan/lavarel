<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>表单请求</title>
        <link href="{{ asset('css/app.css')  }}" rel="stylesheet">
    </head>
    <body>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('form.submit') }}" method="POST" id="app">
              <div class="form-group">
                  <label>标题</label>
                  <input type="text" name="title" class="form-control" placeholder="输入标题">
              </div>
              <div class="form-group">
                  <label>URL</label>
                  <input type="text" name="url" class="form-control" placeholder="输入URL">
              </div>
              <fileupload-component></fileupload-component>
              <button type="submit" class="btn btn-primary">提交</button>
        </form>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>