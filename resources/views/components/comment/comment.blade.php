@props([
	"comment"
])
<div class="text-sm">
        {{ $comment->user->full_name }} said:
        <p>{!! $comment->content !!}</p>
        <p>
            <time
                    datetime="{{ $comment->created_at }}"
                    title="{{ $comment->created_at }}"
            >{{ $comment->created_at_human }}</time>
        </p>
</div>
