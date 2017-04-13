@extends('cpanel.master')

@section('title')
    مشاهده دیدگاه ::
    {{$cm->username}}
@endsection

@section('content')
    <div id="show-single-comment">
        <?php $posttype = $cm->post()->first()->posttype()->first()->name ?>
        <?php $hifen = $cm->post()->first()->hifen_title ?>
        <table>
            <tr>
                <td>نام و نام خانوادگی</td>
                <td>{{$cm->username}}</td>
            </tr>
            <tr>
                <td>ایمیل</td>
                <td class="direction-ltr">{{$cm->email}}</td>
            </tr>
            <tr>
                <td>محتوای دیدگاه</td>
                <td>{{$cm->content}}</td>
            </tr>
            <tr>
                <td>ایجاد شده در تاریخ:</td>
                <td>{{ConvertNumbers($jalali->forge($cm->created_at->timestamp)->format("در ساعت : %H:%M روز  %A %e %B ماه سال %Y"))}}</td>
            </tr>
            <tr>
                <td>آخرین تغییر در تاریخ:</td>
                <td>{{ConvertNumbers($jalali->forge($cm->updated_at->timestamp)->format("در ساعت : %H:%M روز  %A %e %B ماه سال %Y"))}}</td>
            </tr>
        </table>

        <div class="btn-group btn-gp-green">
            @if(!$cm->verified)
                {{link_to_route('verifyComment','تایید ',$cm->id,['class'=>'btn-gp'])}}
            @endif
            {{link_to_route('deleteComment','حذف ',$cm->id,['class'=>'btn-gp','onclick'=>'confirm("آیا از حذف این دیدگاه اطمینان دارید؟")'])}}
            {{link_to_route('editComment','ویرایش ',$cm->id,['class'=>'btn-gp'])}}
            {{link_to_route($posttype,'مشاهده پست ',$hifen,['class'=>'btn-gp','target'=>'_blank'])}}
        </div>
    </div>
@endsection