@extends("app", ["title" => "Hi"])
@section("content")
    <ul class="divide-stone-300 divide-y">
        @forelse($posts as $post)
            <li class="p-4">
                <x-post :post="$post" />
            </li>
        @empty
            <li>There are no posts right now.</li>
        @endforelse
    </ul>
@endsection