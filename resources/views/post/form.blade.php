@extends("app", ["title" => "Create Post"])
@section("content")
    <form
            action="{{ route('posts.store') }}"
            method="post"
    >
        @csrf
        <h2>Create Post</h2>
        <div><textarea
                    name="content"
                    id="content"
                    rows="10"
                    class="w-full min-h-10 border-stone-300 p-2 border rounded-xl"
            ></textarea></div>
            @error("content") <div class="text-red-500">{{ $message }}</div>@enderror
        <button
                type="submit"
                value="Submit"
                class="bg-stone-100 border border-stone-300 rounded-xl px-4 py-2"
        >Submit
        </button>
    </form>
@endsection