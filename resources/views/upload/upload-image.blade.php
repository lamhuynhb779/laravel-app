<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 7 - Image Upload Example</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
        .wrap {
            padding: 30px 0;
        }
        h2 {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="wrap">

                    <h2>Laravel Multiple Image Upload with Intervention Images Package Example</h2>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
            
                    @if(is_countable($images) && count($images) > 0)
                        <div class="row">
                            <div class="col-md-8">
                                <strong>Original Image:</strong>
                            </div>
                            <div class="col-md-4">
                                <strong>Thumbnail Image:</strong>
                            </div>
                            @foreach($images as $img)
                                <div class="col-md-8">
                                    <img src="/images/{{$img->file}}" style="width:400px" />
                                </div>
                                <div class="col-md-4">
                                    <img src="/images/thumbs/{{$img->file}}"  />
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your file.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ URL::to('/upload-image') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                            <input type="file" name="upload[]" multiple>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-info">Upload</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>    
    </div>
</body>
</html>