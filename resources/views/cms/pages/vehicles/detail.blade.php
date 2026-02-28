@extends('cms.layouts.main')

@push('addon-style')
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css" rel="stylesheet">
@endpush

@section('container')
    <div class="mt-3 flex flex-col gap-5 justify-center py-5 overflow-y-scroll custom-scrollbar no-scrollbar">
        <form action="{{ route('vehicles.update', $data) }}" method="POST" enctype="multipart/form-data" id="formInput" class="h-fit w-full bg-white drop-shadow-md rounded-lg px-3 lg:px-8 py-3 lg:py-10 flex flex-col gap-7 lg:gap-10 items-center">
            @csrf
            @method('PUT')
            <div class="w-full gap-5 grid grid-cols-1 md:grid-cols-3">
                <div class="flex flex-col gap-2">
                    <label htmlFor='brand' class="text-sm md:text-base italic px-3">Brands</label>
                    <div class="h-10 border {{ $errors->has('brand') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder=''
                            name="brand" id="brand" required
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('brand', $data->model->brand->name) }}' />
                    </div>
                    <small class="text-xs italic font-light ms-3 text-gray-500">Toyota, Honda, Daihatsu, etc.</small>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='model' class="text-sm md:text-base italic px-3">Model</label>
                    <div class="h-10 border {{ $errors->has('model') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder=''
                            name="model" id="model" required
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('model', $data->model->name) }}' />
                    </div>
                    <small class="text-xs italic font-light ms-3 text-gray-500">Avanza, Xenia, Brio, etc.</small>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='model_note' class="text-sm md:text-base italic px-3">Model Note</label>
                    <div class="h-10 border {{ $errors->has('model_note') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder=''
                            name="model_note" id="model_note"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('model_note', $data->model->note) }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='engine' class="text-sm md:text-base italic px-3">Engine</label>
                    <div class="h-10 border {{ $errors->has('engine') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder=''
                            name="engine" id="engine"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('engine', $data->engine) }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='year_start' class="text-sm md:text-base italic px-3">Years Start</label>
                    <div class="h-10 border {{ $errors->has('year_start') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder=''
                            name="year_start" id="year_start"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('year_start', $data->year_start) }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='year_end' class="text-sm md:text-base italic px-3">Years End</label>
                    <div class="h-10 border {{ $errors->has('year_end') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder=''
                            name="year_end" id="year_end"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('year_end', $data->year_end) }}' />
                    </div>
                </div>
            </div>
            <div class="w-full gap-5 grid grid-cols-1">
                <div class="flex flex-col gap-2">
                    <span class="text-sm md:text-base italic px-3">
                        Compatible Batteries
                    </span>

                    <div class="border {{ $errors->has('batteries') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full p-3 max-h-60 overflow-y-auto">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                            @foreach($batteries as $battery)
                                <label class="flex items-start gap-3 p-2 rounded-lg hover:bg-gray-100 cursor-pointer">
                                    <input
                                        type="checkbox"
                                        name="batteries[]"
                                        value="{{ $battery->id }}"
                                        class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"

                                        {{ in_array($battery->id, old('batteries', $selectedBatteries ?? [])) ? 'checked' : '' }}
                                    >
                                    <div class="flex flex-col">
                                        <span class="font-medium text-sm text-gray-800">
                                            {{ $battery->model }} - {{ $battery->type }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            • {{ $battery->ah }}AH
                                            • {{ $battery->cca }}CCA
                                            • {{ $battery->weight }}KG
                                        </span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <small class="text-xs italic font-light ms-3 text-gray-500">
                        Pilih satu atau lebih battery yang kompatibel
                    </small>
                </div>
            </div>

            <div class='mt-5 flex flex-row gap-2 w-full justify-end items-center'>
                @if (Auth::user()->roles == 'admin')
                    <button type="submit" id="btnSubmit" class='w-fit px-7 rounded-xl py-2 text-white bg-green-600 hover:bg-green-800 cursor-pointer flex flex-row gap-2 items-center'>
                        <i class="fa-solid fa-save"></i>
                        <span>Simpan</span>
                    </button>
                @endif
                <a href="{{ route('vehicles.index') }}" class='w-fit px-7 rounded-xl py-2 text-white bg-red-600 hover:bg-red-800 cursor-pointer flex flex-row gap-2 items-center'>
                    <i class="fa-solid fa-circle-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </form>

        <div class="mt-5 py-5 overflow-y-scroll custom-scrollbar no-scrollbar w-full bg-white/80 drop-shadow-md rounded-lg px-3">
            <table id="datatable" class="display w-full min-w-225 whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Weight</th>
                        <th>AH</th>
                        <th>CCA</th>
                        <th>Length</th>
                        <th>Width</th>
                        <th>Height</th>
                        <th>Total Height</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->batteries as $item)
                        <tr>
                            <td>{{ $item->model }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->Weight }} KG</td>
                            <td>{{ $item->ah }}</td>
                            <td>{{ $item->cca }}</td>
                            <td>{{ $item->length }} MM</td>
                            <td>{{ $item->width }} MM</td>
                            <td>{{ $item->height }} MM</td>
                            <td>{{ $item->total_height }} MM</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                layout: {
                    topStart: {
                        buttons: ['csv', 'excel', 'print']
                    }
                },
                order: [
                    [0, 'desc']
                ]
            });
        });

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