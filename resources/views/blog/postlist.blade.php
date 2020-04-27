<div class="card mb-3">
    <img src="https://images3.alphacoders.com/823/thumb-1920-82317.jpg" height="300px" class="card-img-top">
    <div class="card-body">
      <h5 class="card-title">List Of All Posts</h5>
      <p class="card-text">Here you can find the information of all the posts.</p>
        
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">TITLE</th>
                <th scope="col">DESCRIPTION</th>
                <th scope="col">Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($posts as $key => $post)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->desc}}</td>
                <td>
                    <a href="{{ url('posts/'.$post->id)}}" class="btn btn-sm btn-info">Show</a>
                    <a href="{{ url('posts/'.$post->id.'/edit')}}" class="btn btn-sm btn-warning">Edit</a>
                    {!!Form::open(['action'=>['PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                    {!!Form::close() !!}  
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

