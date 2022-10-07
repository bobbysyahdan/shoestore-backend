<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Category') }}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            var dataTable = $("#crudTable").DataTable({
                ajax: {
                    url: "{!! url()->current() !!}",
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        width: '5%'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '25%'
                    }
                ],
            });
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col-md-12 mb-5">
                <a href="{{ route('dashboard.productCategory.create') }}" class="btn btn-primary">Create Data</a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="col-md-12 bg-white sm:p-6">
                    <table id="crudTable" class="w-full table-auto">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>