@extends('authentications.auth')

@push('addon-style')
@endpush

@section('container')
    <main x-data="{ show: false }" class="w-screen min-h-screen flex flex-col justify-center items-center p-3 md:p-5">
        <form action="{{ route('authenticate') }}" method="post" class="bg-white rounded-3xl px-5 md:px-10 py-12 flex flex-col gap-7 w-11/12 md:w-[70%] lg:w-[40%] shadow-md text-black">
            @csrf
            <div class="flex flex-col justify-center items-center gap-3">
                <div class="w-32 h-32 rounded-full">
                    <img src="/assets/BIT.jpg" alt="Logo BIT" loading="lazy" class="w-full h-full rounded-full object-cover">
                </div>
                <h1 class="font-bold tracking-[5px] uppercase text-3xl">Admin ZOne</h1>
                <h1 class="font-semibold tracking-[2px] uppercase text-xl">AKI Finder</h1>
            </div>

            <div class="mt-6">
                <label htmlFor='email' class="block text-sm font-semibold mb-1 transition-opacity duration-200">Email</label>
                <input type="email" placeholder=""
                    autocomplete="email" id='email' name='email'
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-700 focus:border-0 outline-none placeholder:italic" />
        
                <label htmlFor='password' class="block text-sm font-semibold mt-4 mb-1">Password</label>
                <div class="relative">
                    <input
                        :type="show ? 'text' : 'password'"
                        id="password"
                        name="password"
                        autocorrect="off"
                        autocapitalize="off"
                        spellcheck="false"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-700 focus:border-0 outline-none"
                    />

                    <div 
                        role="button"
                        @click="show = !show"
                        class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500"
                    >
                        <i
                            :class="show ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"
                            class="text-lg"
                        ></i>
                    </div>
                </div>

                <button type="submit"
                    class='bg-black/70 cursor-pointer w-full text-white font-semibold py-3 mt-10 rounded-lg shadow-lg hover:bg-black/90 tracking-wide'>
                    Login
                </button>

                <small class="block text-center mt-10 text-gray-500 font-light">
                    v{{ config('app.version') }} &copy; {{ date('Y') }} BIT.
                </small>
            </div>
        </form>
    </main>
@endsection

@push('addon-script')
@endpush