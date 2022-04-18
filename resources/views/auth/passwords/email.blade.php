@extends('layouts.base')

@section('title', 'Reset Password')

@section('content')
    <section class="mx-auto my-10 bg-gray-700 w-3/4 2xl:w-1/2 xl:w-1/2 lg:w-2/4 md:w-2/4 rounded-xl p-5">
        <h4 class="text-center text-white text-2xl mb-3 font-bold tracking-wide">Password Reset</h4>
        @if (session('status'))
            <div class="p-4 rounded-lg bg-green-700 mb-3 text-center">
                <strong class="text-sm text-green-200">{{ session('status') }}</strong>
            </div>
        @endif
        <form action="{{ route('password.email') }}" method="post">
            @csrf
            <label for="email" class="text-white mb-2">E-mail Address</label>
            <input type="email" id="email" class="form-input block p-1 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
            <span class="text-red-400 block" role="alert">
                <strong class="text-sm">{{ $message }}</strong>
            </span>
            @enderror
            <button type="submit" class="text-left mt-4 font-bold tracking-wide px-4 py-1.5 bg-blue-500 hover:bg-blue-700 transition duration-200 text-white text-sm rounded-lg">Send Password Reset Link</button>
        </form>
    </section>
@endsection