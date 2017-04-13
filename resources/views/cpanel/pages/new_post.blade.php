@extends('cpanel.master')

@section('title')
   ایجاد خبر جدید
@endsection

@section('content')
    <div class="form-group">
        {!! Form::open(['url'=>'admin-panel']) !!}

            {!! Form::hidden('post_type_id',1) !!}
            {!! Form::hidden('_token',csrf_token(),['class'=>'_token']) !!}

            <div class="item">
                <p class="input">عنوان مطلبی قصد ارسالش را دارید وارد کنید :</p>
                {!! Form::text('title') !!}
                {{--<span class="tooltip">این مکان را باید پر کنید.</span>--}}
            </div>

            <div class="item">
                <p>محتوای خبر را در کادر زیر وارد کنید :</p>
                {!! Form::textarea('content',null,['id'=>'post_content']) !!}

            </div>
            <div class="item upload-image">
                {!! Form::label('name','َعکس خود را انتخاب کنید:') !!}
                {!! Form::file('post_image',['id'=>'file']) !!}
                {!! Form::hidden('image',null,['id'=>'image']) !!}
                {!! Form::hidden('destPath','slideshow/_post/',['id'=>'destPath']) !!}
                <div id="uploaded-image">
                </div>
                <div id="open-window">انتخاب تصویر</div>
                <div id="upload-image">
                    آپلود تصویر
                    {{--<span class="percent">89</span>--}}
                </div>
            </div>
            <div class="checkbox block">
                <label for="radiobtn">
                    {!! Form::checkbox('priority') !!}
                    آیا خبر مهم ای است؟
                </label>
            </div>
            <div class="checkbox block sep">
                <label for="radiobtn">
                    {!! Form::checkbox('addToSlider') !!}
                    به اسلاید شو اضافه شود؟
                </label>
            </div>
            {!! Form::submit('ثبت خبر',['id'=>'submit','class'=>'btn btn-flat-green btn-large float-left btn-wide']) !!}
        
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
    <script src="{{asset('cpanel/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('cpanel/js/checkbox.js')}}"></script>
    <script src="{{asset('cpanel/js/radiobtn.js')}}"></script>
    <script src="{{asset('cpanel/js/upload_image.js')}}"></script>
    <script>
        CKEDITOR.replace('post_content',{'language':'fa','height':300,'toolbarCanCollapse ':'true'});
    </script>
@endsection