@extends('cpanel.master')

@section('title')
    بخش مدیریت اعضا
@endsection

@section('content')
    <div class="form-group">
        {!! Form::open() !!}

        <div class="item">
            <p class="input">نام و نام خانوادگی را وارد کنید :</p>
            {!! Form::text('name') !!}
        </div>
        <div class="item">
            <p class="input">نام کاربری را وارد کنید :</p>
            {!! Form::text('username',null,['class'=>'ltr']) !!}
        </div>
        <div class="item">
            <p class="input">ایمیل را وارد کنید :</p>
            {!! Form::email('email',null,['class'=>'ltr']) !!}
        </div>
        <div class="item">
            <p class="input">رمز عبور را وارد کنید :</p>
            {!! Form::password('password',['class'=>'ltr']) !!}
        </div>
        <div class="item">
            <p class="input">رمز عبور را دوباره وارد کنید :</p>
            {!! Form::password('password_confirmation',['class'=>'ltr']) !!}
        </div>
        <div class="item">
            <p class="input">سطح کاربری را وارد کنید:</p>
            <div class="radiobtn block ">
                <label for="radiobtn">
                    {!! Form::radio('post_type_id',2) !!}
                    مدیر
                </label>
            </div>
            <div class="radiobtn block sep">
                <label for="radiobtn">
                    {!! Form::radio('post_type_id',3,['checked'=>'checked']) !!}
                    نویسنده
                </label>
            </div>
        </div>


        {!! Form::submit('افزودن کاربر',['id'=>'submit','class'=>'btn btn-flat-green btn-large float-left btn-wide']) !!}

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
    <script src="{{asset('cpanel/js/radiobtn.js')}}"></script>
@endsection