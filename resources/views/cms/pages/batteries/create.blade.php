@extends('cms.layouts.main')

@push('addon-style')
@endpush

@section('container')
    <div class="mt-3 flex justify-center py-5 overflow-y-scroll custom-scrollbar no-scrollbar">
        <form action="{{ route('batteries.store') }}" method="POST" enctype="multipart/form-data" id="formInput" class="h-fit w-full bg-white drop-shadow-md rounded-lg px-3 lg:px-8 py-3 lg:py-10 flex flex-col gap-7 lg:gap-10 items-center">
            @csrf
            <div class="w-full gap-5 grid grid-cols-1 md:grid-cols-4">
                <div class="flex flex-col gap-2">
                    <label htmlFor='model' class="text-sm md:text-base italic px-3">Model</label>
                    <div class="h-10 border {{ $errors->has('model') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder='' required
                            name="model" id="model"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('model') }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='type' class="text-sm md:text-base italic px-3">Type</label>
                    <div class="h-10 border {{ $errors->has('type') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder='' required
                            name="type" id="type"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('type') }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='ah' class="text-sm md:text-base italic px-3">AH</label>
                    <div class="h-10 border {{ $errors->has('ah') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='number' placeholder='' required
                            name="ah" id="ah"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('ah') }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='cca' class="text-sm md:text-base italic px-3">CCA</label>
                    <div class="h-10 border {{ $errors->has('cca') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='number' placeholder=''
                            name="cca" id="cca"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('cca') }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='weight' class="text-sm md:text-base italic px-3">Weigth (KG)</label>
                    <div class="h-10 border {{ $errors->has('weight') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='number' placeholder=''
                            name="weight" id="weight"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('weight') }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='length' class="text-sm md:text-base italic px-3">Lenght (MM)</label>
                    <div class="h-10 border {{ $errors->has('length') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder=''
                            name="length" id="length"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('length') }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='width' class="text-sm md:text-base italic px-3">Width (MM)</label>
                    <div class="h-10 border {{ $errors->has('width') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder=''
                            name="width" id="width"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('width') }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='height' class="text-sm md:text-base italic px-3">Height (MM)</label>
                    <div class="h-10 border {{ $errors->has('height') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder=''
                            name="height" id="height"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('height') }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='total_height' class="text-sm md:text-base italic px-3">Total Height (MM)</label>
                    <div class="h-10 border {{ $errors->has('total_height') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder=''
                            name="total_height" id="total_height"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('total_height') }}' />
                    </div>
                </div>
            </div>

            <div class='mt-5 flex flex-row gap-2 w-full justify-end items-center'>
                <button type="submit" id="btnSubmit" class='w-fit px-7 rounded-xl py-2 text-white bg-green-600 hover:bg-green-800 cursor-pointer flex flex-row gap-2 items-center'>
                    <i class="fa-solid fa-save"></i>
                    <span>Simpan</span>
                </button>
                <a href="{{ route('batteries.index') }}" class='w-fit px-7 rounded-xl py-2 text-white bg-red-600 hover:bg-red-800 cursor-pointer flex flex-row gap-2 items-center'>
                    <i class="fa-solid fa-circle-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </form>
    </div>
@endsection

@push('addon-script')
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
    </script>
@endpush