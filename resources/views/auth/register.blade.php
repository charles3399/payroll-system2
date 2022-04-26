@extends('layouts.base')

@section('title', 'Register')

@section('content')
    <section class="mx-auto my-10 bg-gray-700 w-3/4 2xl:w-1/2 xl:w-1/2 lg:w-2/4 md:w-2/4 rounded-xl p-5">
        <h4 class="text-center text-white text-3xl mb-3 font-bold tracking-wide">Register</h4>
        <div class="mb-3">
            <form action="{{ route('register') }}" method="post">
                @csrf
                @method('POST')
                <div class="mb-3 text-left">
                    <label for="name" class="text-white">Name</label>
                    <input type="name" id="name" class="form-input block p-1 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="text-red-400" role="alert">
                            <strong class="text-sm">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 text-left">
                    <label for="email" class="text-white">E-mail Address</label>
                    <input type="email" id="email" class="form-input block p-1 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="example@gmail.com">
                    @error('email')
                        <span class="text-red-400" role="alert">
                            <strong class="text-sm">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 text-left">
                    <label for="password" class="text-white">Password</label>
                    <input id="password" type="password" class="form-input block p-1 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="text-red-400" role="alert">
                            <strong class="text-sm">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 text-left">
                    <label for="password-confirm" class="text-white">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-input block p-1 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="mb-0">
                    <button type="submit" class="px-4 py-1.5 bg-blue-500 hover:bg-blue-700 transition duration-200 text-white text-sm rounded-lg">Register</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function togglePassword() {
            const toggle = document.getElementById('password')
            const show = document.querySelector('.eye-show')
            const hidden = document.querySelector('.eye-hide')
            if(toggle.type === 'password') {
                toggle.type = 'text'
                show.classList.add('hidden')
                show.classList.remove('block')
                hidden.classList.remove('hidden')
                hidden.classList.add('block')
            }
            else {
                toggle.type = 'password'
                show.classList.add('block')
                show.classList.remove('hidden')
                hidden.classList.remove('block')
                hidden.classList.add('hidden')
            }
        }
    </script>
@endpush