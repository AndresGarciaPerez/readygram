<div>

    @if ($posts->count())
    <div class="grid justify-items-center md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ( $posts as $post )
            <div>
                <a href="{{route('posts.show', ['post'=>$post, 'user'=>$post->user])}}">
                    <img class="w-80 h-60" src=" {{asset('uploads'). '/' . $post->imagen}}" alt="Imagen del post: {{$post->titulo}}">
                </a>
                <h1 class="font-bold text-sm capitalize">{{$post->user->username}}</h1>
                <h1 class="font-normal text-sm capitalize text-gray-700">{{$post->created_at->diffForHumans()}}</h1>
            </div>
        @endforeach
    </div>
    <div class="mt-10">
        {{$posts->links()}}
    </div>
    @else
        <p class="text-center">No hay posts, sigue a otros usuarios para ver sus posts</p>
    @endif
</div>