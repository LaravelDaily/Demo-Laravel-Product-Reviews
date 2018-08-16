@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.product-categories.title')</h3>
    @can('product_category_create')
    <p>
        <a href="{{ route('admin.product_categories.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($product_categories) > 0 ? 'datatable' : '' }} @can('product_category_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('product_category_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.product-categories.fields.name')</th>
                        <th>@lang('global.product-categories.fields.description')</th>
                        <th>@lang('global.product-categories.fields.photo')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($product_categories) > 0)
                        @foreach ($product_categories as $product_category)
                            <tr data-entry-id="{{ $product_category->id }}">
                                @can('product_category_delete')
                                    <td></td>
                                @endcan

                                <td field-key='name'>{{ $product_category->name }}</td>
                                <td field-key='description'>{!! $product_category->description !!}</td>
                                <td field-key='photo'>@if($product_category->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $product_category->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $product_category->photo) }}"/></a>@endif</td>
                                                                <td>
                                    @can('product_category_view')
                                    <a href="{{ route('admin.product_categories.show',[$product_category->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('product_category_edit')
                                    <a href="{{ route('admin.product_categories.edit',[$product_category->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('product_category_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.product_categories.destroy', $product_category->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('product_category_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.product_categories.mass_destroy') }}';
        @endcan

    </script>
@endsection