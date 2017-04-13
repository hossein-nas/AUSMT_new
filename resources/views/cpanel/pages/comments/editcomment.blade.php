@extends('cpanel.master')

@section('title')
    بخش ویرایش دیدگاه
@endsection

@section('content')
    <div class="form-group">
        {{Form::open(['url'=>route('updateComment')])}}
            {{Form::hidden('post_id',$cm->id)}}
            <div class="item">
                {{Form::label('نام و نام خانوادگی:')}}
                {{Form::text('name',$cm->username,['readonly'=>'readonly'])}}
            </div>
            <div class="item">
                {{Form::label('نام و نام خانوادگی:')}}
                {{Form::email('email',$cm->email,['readonly'=>'readonly'])}}
            </div>
            <div class="item">
                {{Form::label('محتوای دیدگاه:')}}
                {!! Form::textarea('content',$cm->content,['id'=>'cm_content']) !!}
            </div>
            {!! Form::submit('ذخیره تغییرات',['id'=>'submit','class'=>'btn btn-flat-blue btn-large float-left btn-wide btn-margin-vertical']) !!}

        {{Form::close()}}
    </div>

    @if ($errors->any())
        <ul class="errors">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
@endsection

@section('scripts')
    <script src="{{asset('cpanel/js/ck/ckeditor.js')}}"></script>
    <script>
    </script>
@endsection