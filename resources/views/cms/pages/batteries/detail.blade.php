@extends('cms.layouts.main')

@push('addon-style')
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css" rel="stylesheet">
@endpush

@section('container')
    <div class="mt-3 flex flex-col gap-5 justify-center py-5 overflow-y-scroll custom-scrollbar no-scrollbar">
        <form action="{{ route('batteries.update', $data) }}" method="POST" enctype="multipart/form-data" id="formInput" class="h-fit w-full bg-white drop-shadow-md rounded-lg px-3 lg:px-8 py-3 lg:py-10 flex flex-col gap-7 lg:gap-10 items-center">
            @csrf
            @method('PUT')
            <div class="w-full gap-5 grid grid-cols-1 md:grid-cols-4">
                <div class="flex flex-col gap-2">
                    <label htmlFor='model' class="text-sm md:text-base italic px-3">Model</label>
                    <div class="h-10 border {{ $errors->has('model') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder='' required
                            name="model" id="model"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('model', $data->model) }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='type' class="text-sm md:text-base italic px-3">Type</label>
                    <div class="h-10 border {{ $errors->has('type') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder='' required
                            name="type" id="type"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('type', $data->type) }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='ah' class="text-sm md:text-base italic px-3">AH</label>
                    <div class="h-10 border {{ $errors->has('ah') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='number' placeholder='' required
                            name="ah" id="ah"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('ah', $data->ah) }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='cca' class="text-sm md:text-base italic px-3">CCA</label>
                    <div class="h-10 border {{ $errors->has('cca') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='number' placeholder=''
                            name="cca" id="cca"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('cca', $data->cca) }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='weight' class="text-sm md:text-base italic px-3">Weigth (KG)</label>
                    <div class="h-10 border {{ $errors->has('weight') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='number' placeholder=''
                            name="weight" id="weight"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('weight', $data->weight) }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='length' class="text-sm md:text-base italic px-3">Lenght (MM)</label>
                    <div class="h-10 border {{ $errors->has('length') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder=''
                            name="length" id="length"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('length', $data->length) }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='width' class="text-sm md:text-base italic px-3">Width (MM)</label>
                    <div class="h-10 border {{ $errors->has('width') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder=''
                            name="width" id="width"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('width', $data->width) }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='height' class="text-sm md:text-base italic px-3">Height (MM)</label>
                    <div class="h-10 border {{ $errors->has('height') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder=''
                            name="height" id="height"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('height', $data->height) }}' />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label htmlFor='total_height' class="text-sm md:text-base italic px-3">Total Height (MM)</label>
                    <div class="h-10 border {{ $errors->has('total_height') ? 'border-red-400' : 'border-gray-400' }} rounded-xl w-full flex flex-row justify-between items-center">
                        <input
                            type='text' placeholder=''
                            name="total_height" id="total_height"
                            class="h-full w-full text-xs md:text-sm rounded-xl px-3 focus:outline-none focus:ring-0"
                            value='{{ old('total_height', $data->total_height) }}' />
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
                <a href="{{ route('batteries.index') }}" class='w-fit px-7 rounded-xl py-2 text-white bg-red-600 hover:bg-red-800 cursor-pointer flex flex-row gap-2 items-center'>
                    <i class="fa-solid fa-circle-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </form>

        <div class="mt-5 py-5 overflow-y-scroll custom-scrollbar no-scrollbar w-full bg-white/80 drop-shadow-md rounded-lg px-3">
            <table id="datatable" class="display w-full min-w-225 whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Vehicles</th>
                        <th>Engine</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->variants as $item)
                        <tr>
                            <td>
                                {{ $item->model->brand->name }} {{ $item->model->name }}
                                {{ ($item->year_start && $item->year_end)
                                        ? '(' . $item->year_start . ' - ' . $item->year_end . ')'
                                        : ($item->year_start
                                            ? '(' . $item->year_start . ')'
                                            : ($item->year_end
                                                ? '(' . $item->year_end . ')'
                                                : ''
                                            )
                                        )
                                }}
                            </td>
                            <td>{{ $item->engine ?? '-'}}</td>
                            <td>{{ $item->model->note ?? '-' }}</td>
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