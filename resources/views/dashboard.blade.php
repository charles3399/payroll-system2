@extends('layouts.base')

@section('title', 'Dashboard')

@section('content')
    <section class="flex justify-center items-center">
        <div class="text-white mb-3 p-1">
            <router-view />
        </div>
    </section>
@endsection
