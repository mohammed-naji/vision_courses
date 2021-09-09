@extends('admin.layouts.master')

@section('content')


<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-12">
            <h2 class="mb-4">All Categries</h2>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>


            @endif

            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>

                @forelse ($categries as $category)
                    <tr>
                        <th>{{ $category->id }}</th>
                        <th>{{ $category->name }}</th>
                        <th>{{ $category->created_at->format('d - m - Y') }}</th>
                        <th>
                            <a class="btn btn-sm btn-primary" href="{{ route('categories.edit', $category->id) }}"><i class="fas fa-edit"></i></a>
                            <form class="d-inline" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('are you sure?')" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                            </form>
                        </th>
                    </tr>
                @empty

                @endforelse

            </table>

        </div>

    </div>

</div>
@stop
