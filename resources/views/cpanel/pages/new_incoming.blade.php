@extends('cpanel.master')

@section('title')
  ثبت پیشآمد جدید
@endsection

@section('content')
    <div class="form-group">
        {!! Form::open(['url'=>'admin-panel']) !!}

            {!! Form::hidden('post_type_id',6) !!}

            <div class="item">
                <p class="input">عنوان پیشآمد را در کار زیر وارد کنید:</p>
                {!! Form::text('title') !!}
            </div>
            <div class="item">
                <p>محتوای پیشآمد را در کادر زیر وارد کنید :</p>
                {!! Form::textarea('content',null,['id'=>'post_content']) !!}
            </div>

            <div class="date">
                {!! Form::text('year',\Morilog\Jalali\jDate::forge()->format('%y')) !!}
                {!! Form::text('month',\Morilog\Jalali\jDate::forge()->format('%m')) !!}
                {!! Form::text('day',\Morilog\Jalali\jDate::forge()->format('%d')) !!}
            </div>

            {!! Form::submit('ثبت پیشآمد',['id'=>'submit','class'=>'btn btn-flat-green btn-large float-left btn-wide']) !!}

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
    <script>
        CKEDITOR.replace('post_content',{'language':'fa','height':300,'toolbarCanCollapse ':'true'});
    </script>
@endsection