@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.reviews.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($reviews) > 0 ? 'datatable' : '' }} @can('product_category_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('product_category_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.reviews.fields.time')</th>
                        <th>@lang('global.reviews.fields.product')</th>
                        <th>@lang('global.reviews.fields.user')</th>
                        <th>@lang('global.reviews.fields.rating')</th>
                        <th>@lang('global.reviews.fields.comment')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($reviews) > 0)
                        @foreach ($reviews as $review)
                            <tr data-entry-id="{{ $review->id }}">
                                @can('product_category_delete')
                                    <td></td>
                                @endcan

                                <td field-key='time'>{{ $review->created_at }}</td>
                                <td field-key='time'>{{ $review->product->name }}</td>
                                <td field-key='time'>{{ $review->user->name }}</td>
                                <td field-key='time'>{{ $review->rating }}</td>
                                <td field-key='time'>{{ $review->comment }}</td>
                                <td>
                                    @can('product_category_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.reviews.destroy', $review->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('global.app_no_entries_in_table')</td>
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
            window.route_mass_crud_entries_destroy = '{{ route('admin.reviews.mass_destroy') }}';
        @endcan

    </script>
@endsection