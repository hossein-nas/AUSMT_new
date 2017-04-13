@extends('cpanel.master')

@section('title')
    ایجاد برگه جدید
@endsection

@section('content')
    <div class="form-group">
        {!! Form::open(['url'=>'admin-panel']) !!}

        {!! Form::hidden('post_type_id',2) !!}
        {!! Form::hidden('_token',csrf_token(),['class'=>'_token']) !!}

        <div class="item">
            <p class="input">عنوان برگه ای که قصد دارید ثبت کنید را در کادر زیر وارد کنید:</p>
            {!! Form::text('title') !!}
            {{--<span class="tooltip">این مکان را باید پر کنید.</span>--}}
        </div>

        <div class="item">
            <p>مطالب مورد نظر خود را در کادر زیر وارد کنید:</p>
            {!! Form::textarea('content',null,['id'=>'post_content']) !!}

        </div>

        {!! Form::submit('ثبت برگه',['id'=>'submit','class'=>'btn btn-flat-green btn-large float-left btn-wide']) !!}

        {!! Form::close() !!}
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
        CKEDITOR.replace('post_content',{'language':'fa','height':300,'toolbarCanCollapse ':'true'});
    </script>
@endsection