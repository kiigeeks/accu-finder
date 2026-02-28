@extends('cms.layouts.main')

@push('addon-style')
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css" rel="stylesheet">
@endpush

@section('container')
    <div class="mt-3 font-poppins flex justify-end py-5 overflow-y-scroll custom-scrollbar no-scrollbar">
        @if (Auth::user()->roles == 'admin')
            <a href="{{ route('vehicles.create') }}" class="bg-blue-600 hover:bg-blue-800 text-white px-5 py-2 rounded-lg cursor-pointer flex flex-row gap-2 items-center">
                <i class="fa-solid fa-circle-plus"></i>
                <span>Add New</span>
            </a>
        @endif
    </div>

    <div class="mt-5 py-5 overflow-y-scroll custom-scrollbar no-scrollbar w-full bg-white/80 drop-shadow-md rounded-lg px-3">
        <table id="datatable" class="display w-full min-w-225 whitespace-nowrap">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Vehicles</th>
                    <th>Battery</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $item)
                    <tr>
                        <td>{{ $item->created_at->format('d F Y H:i') }}</td>
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
                        <td>
                            @foreach ($item->batteries as $battery)
                                <a href="{{ route('batteries.show', $battery) }}" class="underline  underline-offset-2 text-blue-700">{{ $battery->model. ' - ' .$battery->type }}</a>
                                @if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('vehicles.show', $item) }}" class='w-fit px-4 py-1.5 rounded-lg bg-cyan-600 hover:bg-cyan-800 text-white cursor-pointer flex flex-row gap-2 items-center'>
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
    </script>
@endpush