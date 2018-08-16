@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.products.title')</h3>

    <div class="panel-body table-responsive">
        <div class="row">
            <div class="col-md-10">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>@lang('global.products.fields.name')</th>
                        <td field-key='name'>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>@lang('global.products.fields.description')</th>
                        <td field-key='description'>{!! $product->description !!}</td>
                    </tr>
                    <tr>
                        <th>@lang('global.products.fields.category')</th>
                        <td field-key='category'>
                            @foreach ($product->category as $singleCategory)
                                <span class="label label-info label-many">{{ $singleCategory->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>@lang('global.products.fields.tag')</th>
                        <td field-key='tag'>
                            @foreach ($product->tag as $singleTag)
                                <span class="label label-info label-many">{{ $singleTag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>@lang('global.products.fields.photo1')</th>
                        <td field-key='photo1'>@if($product->photo1)<a href="{{ asset(env('UPLOAD_PATH').'/' . $product->photo1) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $product->photo1) }}"/></a>@endif</td>
                    </tr>
                    <tr>
                        <th>@lang('global.products.fields.photo2')</th>
                        <td field-key='photo2'>@if($product->photo2)<a href="{{ asset(env('UPLOAD_PATH').'/' . $product->photo2) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $product->photo2) }}"/></a>@endif</td>
                    </tr>
                    <tr>
                        <th>@lang('global.products.fields.photo3')</th>
                        <td field-key='photo3'>@if($product->photo3)<a href="{{ asset(env('UPLOAD_PATH').'/' . $product->photo3) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $product->photo3) }}"/></a>@endif</td>
                    </tr>
                </table>
            </div>
        </div>

        <a href="{{ route('admin.home') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
    </div>

    <hr />

    @if (!$product->reviews()->where('user_id', auth()->id())->count() && $product->user_id != auth()->id())
    <h3>Leave a review</h3>

    <form action="{{ route('admin.reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}" />
        Your rating:
        <br />
        <select name="rating">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option selected>4</option>
            <option>5</option>
        </select>
        <br /><br />
        Comment (optional):
        <br />
        <textarea name="comment"></textarea>
        <br /><br />
        <input type="submit" value="Save rating" />
    </form>
    @endif

@stop


