@extends('cms.layouts.main')

@push('addon-style')
@endpush

@section('container')
    <div class="mt-3 flex flex-col gap-5 justify-center py-5 overflow-y-scroll custom-scrollbar no-scrollbar">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="formInput" class="h-fit w-full bg-white drop-shadow-md rounded-lg px-3 lg:px-8 py-3 lg:py-10 flex flex-col gap-7 lg:gap-10 items-center">
            @csrf
            @method('PUT')
            <div class="w-full gap-5 grid grid-cols-1 md:grid-cols-3">
                <div class="flex flex-col gap-2">
                    <label htmlFor='fullname' class="text-sm md:text-base italic px-3">Fullname</label>
                    <div class="h-10 border {{ $errors->has('fullname') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder=''
                            name="fullname" id="fullname"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('fullname', auth()->user()->fullname) }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='email' class="text-sm md:text-base italic px-3">Email</label>
                    <div class="h-10 border {{ $errors->has('email') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='email' placeholder=''
                            name="email" id="email"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('email', auth()->user()->email) }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='password' class="text-sm md:text-base italic px-3">Password</label>
                    <div class="h-10 border {{ $errors->has('password') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='password' placeholder=''
                            name="password" id="password"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('password') }}' />
                    </div>
                </div>
            </div>

            <div class='mt-5 flex flex-row gap-2 w-full justify-end items-center'>
                @if (Auth::user()->roles == 'admin')
                    <button type="submit" id="btnSubmit" class='w-fit px-7 rounded-xl py-2 text-white bg-green-600 hover:bg-green-800 cursor-pointer flex flex-row gap-2 items-center'>
                        <i class="fa-solid fa-save"></i>
                        <span>Simpan</span>
                    </button>
                @endif
            </div>
        </form>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('formInput');
            const btnSubmit = document.getElementById('btnSubmit');

            form.addEventListener('submit', function () {
                btnSubmit.disabled = true;
                btnSubmit.innerHTML = 'Loading ...';
            });

            @if ($errors->any())
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = 'Submit';
            @endif
        });

        document.getElementById('formInput').addEventListener('submit', function(e) {
            const isAdmin = "{{ Auth::user()->roles }}" === "admin";
            if(!isAdmin){
                e.preventDefault();

                Swal.fire({
                    icon: 'warning',
                    title: 'Akses Ditolak',
                    text: 'Hanya admin yang dapat mengubah data'
                });
                return false;
            }
        });
    </script>
@endpush