@extends('layouts.base')

@section('title', 'Update Password')

@section('content')
    <section class="mx-auto my-10 bg-gray-700 w-3/4 2xl:w-1/2 xl:w-1/2 lg:w-2/4 md:w-2/4 rounded-xl p-5">
        <h4 class="text-center text-white text-2xl mb-3 font-bold tracking-wide">Update Password</h4>
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-3 text-left">
                <label for="email" class="text-white mb-2">E-mail Address</label>
                <input type="email" id="email" class="form-input block p-1 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
                @error('email')
                <span class="text-red-400 block" role="alert">
                    <strong class="text-sm">{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3 text-left">
                <label for="password" class="text-white mb-2">Password</label>
                <input type="password" name="password" id="password" class="form-input block p-1 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" required autocomplete="new-password">
                @error('password')
                    <span class="text-red-400 block" role="alert">
                        <strong class="text-sm">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3 text-left">
                <label for="password-confirm" class="text-white mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password-confirm" class="form-input block p-1 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" required autocomplete="new-password">
            </div>
            <button type="submit" class="text-left mt-4 font-bold tracking-wide px-4 py-1.5 bg-blue-500 hover:bg-blue-700 transition duration-200 text-white text-sm rounded-lg">Reset Password</button>
        </form>
    </section>
@endsection