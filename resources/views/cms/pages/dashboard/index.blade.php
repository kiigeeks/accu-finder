@extends('cms.layouts.main')

@push('addon-style')
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css" rel="stylesheet">
@endpush

@section('container')
    <div class="mt-3 font-poppins flex flex-col gap-5 md:gap-3 justify-center py-5 overflow-y-scroll custom-scrollbar no-scrollbar">
        <div class="flex flex-col md:flex-row justify-between px-1 mb-5 md:mb-8">
            <div class="md:bg-white md:rounded-xl md:shadow-md px-1 md:px-5 py-1 flex items-center">
                <div class="text-sm text-gray-500">
                    <i class="fa-solid fa-user-tie mr-1"></i>
                    Halo, {{ auth()->user()->fullname }}
                </div>
            </div>
            <div class="md:bg-white md:rounded-xl md:shadow-md px-1 md:px-5 py-1 flex items-center">
                <div class="text-sm text-gray-500">
                    <i class="fa-regular fa-clock mr-1"></i>
                    <span id="clock"></span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-5 md:mb-8">
            <div class="bg-white rounded-xl shadow-md p-5 flex items-center gap-4">
                <div class="bg-green-100 text-green-600 p-3 rounded-lg text-2xl">
                    <i class="fa-solid fa-car-side"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Vehicles</p>
                    <h2 class="text-xl font-bold text-gray-800">
                        {{ $vehicles }}
                    </h2>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-5 flex items-center gap-4">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-lg text-2xl">
                    <i class="fa-solid fa-car-battery"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Batteries</p>
                    <h2 class="text-xl font-bold text-gray-800">
                        {{ $batteries }}
                    </h2>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('addon-script')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        

        const updateClock = () => {
            const now = new Date();

            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            const date = now.toLocaleDateString('id-ID', options);
            const time = now.toLocaleTimeString('id-ID');

            document.getElementById("clock").innerHTML = date + " | " + time;
        }

        setInterval(updateClock, 1000);

        updateClock();

        
    </script>
@endpush