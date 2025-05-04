@props([
	"href",
	"action",
	"date"
])

@php
$date_human = \Carbon\Carbon::parse($date)->diffForHumans();
@endphp
<div class="details">
    <a href="{{ $href }}"> {{ $action ?? "Posted" }} <time
                datetime="{{ $date }}"
                title="{{ $date }}"
        >{{ $date_human }}</time></a>
</div>