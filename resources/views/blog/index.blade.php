<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
      body {
      background-image: url('https://i.imgur.com/cji4OHQ.jpg');
    }
    .card-body{
      background-image: url('https://www.aimcobd.com/images/bg1.jpg');
    }
      .navbar{
      background-image: url('https://www.elsetge.cat/myimg/f/1-12083_dark-hd-wallpapers-1080p-dark-wallpaper-1080p-background.jpg');
      }
    </style>

    <title>My Blog</title>
  </head>
  <body>

    @include('blog.navbar')

    <div class="container">
      <div class="row">
        @include('blog.message')
      </div>
    </div>

    <div class="row header-container justify-content-center">
      <div class="header">
          <h1>My Blog</h1>
      </div>
    </div>

    @if ($layout == 'index')
    <div class="container-fluid mt-2">
      <div class="container-fluid mt-2">
          <div class="row justify-content-center">
              <section class="col-md-8">
                  @include('blog.postlist')
                  {{ $posts->render() }}
              </section>
          </div>
      </div>
    </div>

    @elseif ($layout == 'create')
    <div class="container-fluid mt-2">
        <div class="row">
            <section class="col-md-7">
                @include('blog.postlist')
                {{ $posts->render() }}
            </section>
            <section class="col-md-5">
                <div class="card mb-3">
                    <img src="https://www.elsetge.cat/myimg/f/0-7004_blog-post-image-silver-glitter-background-hd.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Enter the information of new Post</h5>
                          <form action="{{ url('/posts')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="cne">Title</label>
                                <input name="title" id="title" type="text" class="form-control" placeholder="Enter Title">
                            </div>
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <input name="desc" id="desc" type="text" class="form-control" placeholder="Enter Description">
                            </div>
                            <input type="file" class="btn btn-default" name="image" id="image">
                            <input type="submit" class="btn btn-info" value="Save">
                            <input type="submit" class="btn btn-warning" value="Reset">
                          </form>
                    </div>
                  </div>
            </section>
        </div>
    </div>

    @elseif($layout == 'show')
    <div class="container-fluid mt-2">
        <div class="container-fluid mt-2">
            <div class="row justify-content-center">
                <section class="col-md-8">
                    @include('blog.show')
                </section>
            </div>
        </div>
    </div> 

    @elseif($layout == 'edit')
      <div class="container-fluid mt-2">
          <div class="row">
              <section class="col-md-7">
                  @include('blog.postlist')
                  {{ $posts->render() }}
              </section>
              <section class="col-md-5">
                  <div class="card mb-3">
                      <img src="/storage/images/{{$post->image}}" class="card-img-top" alt="Image">
                      <div class="card-body">
                        <h5 class="card-title">Update the information of the Post</h5>
                        <form action="{{ url('posts/'.$post->id)}}" method="post">
                          
                              @csrf
                              <div class="form-group">
                                  <label for="title">Title</label>
                                  <input value="{{$post->title}}" name="title" id="title" type="text" class="form-control" placeholder="Enter Title">
                              </div>
                              <div class="form-group">
                                  <label for="desc">Description</label>
                                  <input value="{{$post->desc}}" name="desc" id="desc" type="text" class="form-control" placeholder="Enter Description">
                              </div>
                              <input type="file" class="btn btn-default" name="image" id="image">
                              <input type="submit" class="btn btn-info" value="Update">
                              <input type="hidden" name="_method" value="put" />  
                              <input type="submit" class="btn btn-warning" value="Reset">
                          </form>
                      </div>
                    </div>
              </section>
          </div>
      </div>
    @endif
    


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>