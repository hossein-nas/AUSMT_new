@extends('old_cpanel.master')

@section('title')
    بخش مدیریت اعضا
@endsection

@section('content')
    @if($allUsers->count())
        <table class="userTable">
            <tr>
                <th>نام و نام خانوادگی</th>
                <th>نام کاربری</th>
                <th>ایمیل</th>
                <th>سطح کاربری</th>
                <th>ایجاد شده در</th>
                <th>آخرین تغییرات</th>
            </tr>
            @foreach($allUsers as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->usertype->type_name_per}}</td>
                    <td>{{toPersianNums($jalali->forge($user->created_at->timestamp)->format("%e %B %y - %H:%M"))}}</td>
                    <td>{{toPersianNums($jalali->forge($user->updated_at->timestamp)->format("%e %B %y - %H:%M"))}}</td>
                </tr>
            @endforeach
        </table>

        <div class="btn-group btn-gp-blue">
            {{Form::button('حذف کاربر',['class'=>'btn-gp'])}}
            {{Form::button('ویرایش کاربر',['class'=>'btn-gp'])}}
            {{Form::button('غیرفعال کردن',['class'=>'btn-gp'])}}
            {{link_to_route('addNewMember','ایجاد کاربر جدید',null,['class'=>'btn-gp'])}}
        </div>
    @else
        <span class="no-text"></span>
    @endif
@endsection