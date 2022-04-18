@extends('layouts.base')

@section('title','LaraPayroll')

@section('content')
    <section class="flex flex-col justify-center items-center my-5">
        <div class="text-white mb-3">
            <h1 class="uppercase text-xl xl:text-3xl lg:text-3xl md:text-3xl font-extrabold italic tracking-wider">Welcome @auth {{ Auth::user()->name }}! @endauth</h1>
        </div>
        <div class="bg-gray-700 text-white rounded-md px-3 py-5 mb-3 text-center 2xl:text-left xl:text-left lg:text-left md:text-left w-11/12 2xl:w-1/2 xl:w-1/2 lg:w-5/6 md:w-4/12">
            <span class="uppercase font-bold mb-2 tracking-wider">Whats new?</span>
            <p class="leading-5 tracking-wide">This is an upcoming version 2.0 of Payroll System</p>
        </div>
        <div class="bg-gray-700 text-white rounded-md px-3 py-5 mb-3 text-center 2xl:text-left xl:text-left lg:text-left md:text-left w-11/12 2xl:w-1/2 xl:w-1/2 lg:w-5/6 md:w-4/12">
            <span class="uppercase font-bold mb-2 tracking-wider">Changes?</span>
            <p class="leading-5 tracking-wide">There will be some major upgrades regarding the technology that we use for better performance and <i>smoother</i> user experience</p>
        </div>
        <div class="bg-gray-700 text-white rounded-md px-3 py-5 mb-3 text-center 2xl:text-left xl:text-left lg:text-left md:text-left w-11/12 2xl:w-1/2 xl:w-1/2 lg:w-5/6 md:w-4/12">
            <span class="uppercase font-bold mb-2 tracking-wider">Specific technology?</span>
            <p class="leading-5 tracking-wide mb-2">For frontend, we will use VueJS (a javascript framework for building UI) and Tailwind for decorations.</p>
            <p class="leading-5 tracking-wide">For backend, we will still use Laravel but the latest version (9.x), but this time we will use it differently for better performance compared to the old version.</p>
        </div>
    </section>
@endsection