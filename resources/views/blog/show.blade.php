<div class="card mb-3">
    <img style="object-fit: scale-down; background-color:powderblue;" src="/storage/images/{{$post->image}}">
    <div class="card-body">                                             
    <h5 class="card-title">{{$post->title}}</h5>
        <p class="card-text">Description : {{$post->desc}}</p>
        <p class="card-text"><small class="text-muted">Added on {{$post->created_at}}</small></p>
    </div>
</div>