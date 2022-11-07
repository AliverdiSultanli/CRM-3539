@extends('layouts.app')

@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif
    <form method="POST" class="w-100" action="{{ route('shops.update', $shop->id) }}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Title</label>
            <input type="text"
                   class="form-control"
                   id="name"
                   name="name"
                   placeholder="Enter name"
                   value="{{$shop->name}}">
        </div>

        <div class="form-group w-100">
            <label class="w-100" for="multiselect">Categories</label>
            <select id="multiselect" name="categories[]" multiple="multiple">
                @foreach($categories as $category)
                    <option {{ in_array($category->id, $shop_categories) ? 'selected' : '' }}
                            value="{{ $category->id }}">
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
