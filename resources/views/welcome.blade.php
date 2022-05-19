@extends('layouts.base')

@section('title','LaraPayroll')

@section('content')
    <section class="flex flex-col justify-center items-center my-5">
        <div class="text-white text-center mb-3">
            <h1 class="uppercase text-xl xl:text-3xl lg:text-3xl md:text-3xl font-extrabold italic tracking-wider">Welcome @auth {{ Auth::user()->name }}! @endauth</h1>
            <small class="italic">This website is under development</small>
        </div>
        <div class="bg-gray-700 text-white rounded-md px-3 py-5 mb-3 text-center 2xl:text-left xl:text-left lg:text-left md:text-left w-11/12 2xl:w-1/2 xl:w-1/2 lg:w-5/6 md:w-4/12">
            <span class="uppercase font-bold mb-2 tracking-wider">Whats new?</span>
            <p class="leading-5 tracking-wide">This is an upgraded version of <a href="https://github.com/charles3399/payroll-system" target="_blank" rel="noopener noreferrer" class="underline underline-offset-2 hover:text-violet-400">Payroll System</a></p>
        </div>
        <div class="bg-gray-700 text-white rounded-md px-3 py-5 mb-3 text-center 2xl:text-left xl:text-left lg:text-left md:text-left w-11/12 2xl:w-1/2 xl:w-1/2 lg:w-5/6 md:w-4/12">
            <span class="uppercase font-bold mb-2 tracking-wider">Changes?</span>
            <p class="leading-5 tracking-wide">There will be some major upgrades and restructuring regarding the technology that we use for better performance <i>API integration and new CSS framework</i></p>
        </div>
        <div class="bg-gray-700 text-white rounded-md px-3 py-5 mb-3 text-center 2xl:text-left xl:text-left lg:text-left md:text-left w-11/12 2xl:w-1/2 xl:w-1/2 lg:w-5/6 md:w-4/12">
            <span class="uppercase font-bold mb-2 tracking-wider">Specific technology?</span>
            <p class="leading-5 tracking-wide mb-2">For frontend, we will use VueJS (a javascript framework for building UI) and Tailwind for decorations.</p>
            <p class="leading-5 tracking-wide">For backend, we will still use Laravel but the latest version (9.x), but this time we will use it differently for better performance compared to the old version.</p>
        </div>
    </section>
@endsection