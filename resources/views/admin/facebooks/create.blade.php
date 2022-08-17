@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.facebook.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.facebooks.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.facebook.fields.name') }}</label>
                            @foreach(App\Models\Facebook::NAME_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="name_{{ $key }}" name="name" value="{{ $key }}" {{ old('name', '') === (string) $key ? 'checked' : '' }} required>
                                    <label for="name_{{ $key }}" style="font-weight: 400">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.facebook.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection