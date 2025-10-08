@extends('layouts.masterlayout')
@section('title','IMG')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">IMG Content {{ $id }}</h2>
    <p class="mb-4">This is the main section of the home page with beautiful images.</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 shadow rounded-lg">
            <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Nature Landscape" class="w-full h-48 object-cover rounded-t-lg">
            <p class="mt-2">Nature Landscape</p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg">
            <img src="https://images.pexels.com/photos/1181397/pexels-photo-1181397.jpeg?auto=compress&cs=tinysrgb&w=500" alt="Technology Background" class="w-full h-48 object-cover rounded-t-lg">
            <p class="mt-2">Technology Background</p>
        </div>
    </div>
@endsection