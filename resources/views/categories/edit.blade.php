@extends('layouts.app')

@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif
    <form method="POST" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text"
                   class="form-control"
                   id="title"
                   name="title"
                   placeholder="Enter title"
                   value="{{ $category->title }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
