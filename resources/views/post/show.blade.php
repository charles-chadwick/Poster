@extends("app", ["title" => "Post"])
@section("content")
<x-post :post="$post" />
@endsection