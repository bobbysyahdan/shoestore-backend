<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product Category &raquo Create
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col-md-12">
                @if($errors->any())
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Failed!</strong> 
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endforeach
                    
                @endif
            </div>
            <div class="card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <form action="{{ route('dashboard.productCategory.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary col-md-12 mt-5" style="background-color:#0d6efd; !important">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</x-app-layout>