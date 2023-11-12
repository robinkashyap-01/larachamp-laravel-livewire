@extends('frontend.app')
@section('content')
<div class="banner container py-5">
    <h1 class="siteline" >
        Let's Learn And Build Together
    </h1>
</div>
@include('frontend.components.search')
{{-- @include('frontend.components.categories', ['categories' => $categories ]) --}}
@include('frontend.content', ['posts' => $posts ])
@endsection
@section('title','Blog')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/searchbox.css')}}">
@endpush
