@props([
	"post"
])
<div>
    <a href="{{ route('post.show', $post) }}">
    <h3 class="font-bold">{{ $post->user->full_name }}</h3>
    <p>{!! $post->content !!}</p>
    <p class="text-sm">
        <time
                datetime="{{ $post->created_at }}"
                title="{{ $post->created_at }}"
        >{{ $post->created_at_human }}</time>
    </p>
    </a>
</div>
