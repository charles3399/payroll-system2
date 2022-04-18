@extends('layouts.base')

@section('title', 'Login')

@section('content')
    <section class="mx-auto my-10 bg-gray-700 w-3/4 2xl:w-1/2 xl:w-1/2 lg:w-2/4 md:w-2/4 rounded-xl p-5">
        <h4 class="text-center text-white text-3xl mb-3 font-bold tracking-wide">Login</h4>
        <div class="mb-3">
            <form action="{{ route('login') }}" method="post">
                @csrf
                @method('POST')
                <div class="mb-3 text-left">
                    <label for="email" class="text-white">Email Address</label>
                    <input type="email" id="email" class="form-input block p-1 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="example@gmail.com">
                    @error('email')
                        <span class="text-red-400" role="alert">
                            <strong class="text-sm">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 text-left">
                    <label for="password" class="text-white">Password</label>
                    <input type="password" id="password" class="form-input block p-1 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="text-red-400" role="alert">
                            <strong class="text-sm">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="checkbox" id="remember" class="
                    form-checkbox
                    rounded
                    border-gray-300
                    text-blue-500
                    focus:border-indigo-300
                    focus:ring
                    focus:ring-offset-0
                    focus:ring-indigo-200
                    focus:ring-opacity-50"
                    name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="text-white text-sm mx-1">Remember Me</label>
                </div>
                <div class="mb-0">
                    <button type="submit" class="px-4 py-1.5 bg-blue-500 hover:bg-blue-700 transition duration-200 text-white text-sm rounded-lg">Login</button>
                    @if (Route::has('password.request'))
                        <a class="text-white text-sm hover:underline mx-3" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </section>
@endsection