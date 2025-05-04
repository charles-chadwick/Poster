@extends("app", ["title" => $post->user->full_name."'s Post"])
@section("content")
    <div class="p-4">
        <h3 class="font-bold text-sm">{{ $post->user->full_name }}</h3>
        {!! $post->content !!}
        <hr />
        <p class="text-xs">Posted: {{ $post->created_at_human }}</p>
    </div>
@endsection