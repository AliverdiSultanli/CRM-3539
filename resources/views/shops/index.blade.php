@php use Illuminate\Support\Facades\Session; @endphp
@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <a class="btn btn-primary mb-5" href="{{ route('shops.create') }}">
            Add
        </a>
    </div>
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Categories</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($shops as $shop)
            <tr>
                <th scope="row">{{ $shop->id }}</th>
                <td>{{ $shop->name }}</td>
                <td>
                    @foreach($shop->categories as $category)
                        {{ $category->title }}
                        @if( !$loop->last)
                            ,
                        @endif
                    @endforeach
                </td>
                <td>
                    <a class="btn btn-dark" data-toggle="modal" data-target="#exampleModal" href="javascript:;">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a class="btn btn-warning" href="{{ route('shops.edit', $shop->id) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a class="btn btn-danger" id="delete" data-id="{{ $shop->id }}" href="javascript:;">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>
                                <b>Title: </b> {{ $shop->name }}
                            </p>
                            <p>
                                <b>Slug: </b> {{ $shop->slug }}
                            </p>
                            <p>
                                <b>Categories: </b>
                                @foreach($shop->categories as $category)
                                    {{ $category->title }}
                                    @if( !$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
    <div class="items">
        {{ $shops->links() }}
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready ( function () {
            $(document).on ("click", "#delete", function () {
                let trToRemove = $(this).closest('tr')
                let data_id = $(this).attr('data-id');
                if( confirm('Do you want delete?') )
                    $.ajax({
                        url: "{{ route('delete_shop') }}",
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: data_id,
                        },
                        success: function( data ){
                            let response = data.response;
                            if(response.code === 200){
                                Swal.fire(
                                    'Success!',
                                    response.message,
                                    'success'
                                );
                                trToRemove.remove();
                            }
                            else if(response.code === 500){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                    footer: '<a href>Server Error!</a>'
                                });
                            }
                        },
                        error : (error) => {
                            console.log(error);
                        }
                    });
            });
        });
    </script>
@endsection
