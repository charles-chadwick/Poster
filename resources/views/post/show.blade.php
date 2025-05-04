@extends("app", ["title" => "Post"])
@section("content")
    <x-post :post="$post" />
    <hr>
    <ul class="divide-y divide-stone-200">
    @forelse($post->comments as $comment)
        <x-comment :comment="$comment" />
    @empty
        <li>{{ __("There are no comments for this post.") }}</li>
    @endforelse
    </ul>
@endsection