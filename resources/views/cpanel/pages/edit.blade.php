@extends('cpanel.master')

@section('title')
    ویرایش مطالب ثبت شده
@endsection

@section('content')
    <div class="form-group">
        {!! Form::open(['url'=>'admin-panel/edit']) !!}
        {!! Form::hidden('post_type_id',$p->post_type_id) !!}
        {!! Form::hidden('rel_id',$p->id) !!}
        {!! Form::hidden('_token',csrf_token(),['class'=>'_token']) !!}

        @if($p->post_type_id == 1)
            @include('cpanel.pages.includes.inc_for_edit.edit_post')
        @elseif($p->post_type_id == 2)
            @include('cpanel.pages.includes.inc_for_edit.edit_page')
        @elseif($p->post_type_id == 3)
            @include('cpanel.pages.includes.inc_for_edit.edit_notfication')
        @elseif($p->post_type_id == 4)
            @include('cpanel.pages.includes.inc_for_edit.edit_seminar')
        @elseif($p->post_type_id == 5)
            @include('cpanel.pages.includes.inc_for_edit.edit_other')
        @elseif($p->post_type_id == 6)
            @include('cpanel.pages.includes.inc_for_edit.edit_incoming')
        @endif


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
    <script src="{{asset('cpanel/js/checkbox.js')}}"></script>
    <script src="{{asset('cpanel/js/radiobtn.js')}}"></script>
    <script src="{{asset('cpanel/js/upload_image.js')}}"></script>
    <script>
        CKEDITOR.replace('post_content',{'language':'fa','height':300,'toolbarCanCollapse ':'true'});
    </script>
@endsection