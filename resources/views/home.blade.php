@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('global.app_dashboard')</div>

                <div class="panel-body">
                    <form action="{{ route('admin.home') }}">
                        <input type="text" name="query" placeholder="Search by name" value="{{ request('query', '') }}" />
                        <select name="category_id">
                            <option value="0">-- search by category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                        @if (request('category_id', 0) == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <select name="tag_id">
                            <option value="0">-- search by tag --</option>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                        @if (request('tag_id', 0) == $tag->id) selected @endif>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="Search" />
                    </form>
                    <hr />

                    @foreach ($products as $product)
                        <div class="row">
                            <div class="col-md-2">
                                @if ($product->photo1 != '')
                                <img src="/{{ $product->photo1 }}" width="100" />
                                @endif
                            </div>
                            <div class="col-md-8">
                                <a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a>
                                <br />
                                {{ $product->description }}
                            </div>
                            <div class="col-md-2">
                                @if ($product->reviews_count > 0)
                                {{ number_format($product->avg_rating, 2) }} / 5.00
                                <br />
                                {{ $product->reviews_count }} votes
                                @else
                                    No ratings yet.
                                @endif
                            </div>
                        </div>
                        <hr />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
