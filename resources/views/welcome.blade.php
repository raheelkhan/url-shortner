<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Url Shortener</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,500" rel="stylesheet">
    <link href="assets/css/open-iconic.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <section id="cover">
        <div id="cover-caption">
            <div id="container" class="container">
                <div class="row">
                    <div class="col-sm-10 offset-sm-1 text-center">
                        <h1 class="display-3">Url Shortener</h1>
                        <div class="info-form">
                            {!! Form::open(array('action' => 'IndexController@store', 'method' => 'post', 'class' => 'form-inline justify-content-center')) !!}
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                <div class="form-group">
                                    <label class="sr-only">Url</label>
                                     <input type="text" name="url" class="form-control form-control-lg" placeholder="Enter url here..">
                                </div>
                                <button type="submit" class="btn btn-success btn-lg">okay, go!</button>
                            {!! Form::close() !!}
                        </div>
                        @if(isset($data['error']))
                            <div class="alert alert-danger">{{ $data['error'] }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>