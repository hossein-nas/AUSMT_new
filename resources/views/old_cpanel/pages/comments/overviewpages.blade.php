@extends('old_cpanel.master')

@section('title')
    بخش مدیریت دیدگاه‌ها
@endsection

@section('content')
    <div class="allcomments">
        <section class="unverifiedComments" data-title="دیدگاه های تایید نشده">
            @if($unverified->count())
                @foreach($unverified as $cm)
                    <?php $posttype = $cm->post()->first()->posttype()->first()->name ?>
                    <?php $hifen = $cm->post()->first()->hifen_title ?>
                    <div class="item">
                        <ul>
                            <li>
                                <div class="detail">
                                    <ul>
                                        <li class="name">{{link_to_route('showComment',$cm->username,$cm->id)}}</li>
                                        <li class="email">{{$cm->email}}</li>
                                    </ul>
                                </div>
                                <div class="text">{{$cm->content}}</div>
                                <div class="actions">
                                    <span class="date">{{toPersianNums($jalali->forge($cm->created_at->timestamp)->format("%H:%M - %A %e %B %Y"))}}</span>
                                    {{link_to_route($posttype,'',$hifen,['class'=>'link-to-post','title'=>'مشاهده پست مرتبط','target'=>'_blank'])}}
                                    {{link_to_route('deleteComment','',$cm->id,['class'=>'delete','title'=>'حذف دیدگاه','onclick'=>'return confirm("آیا از حذف این دیدگاه اطمینان دارید؟")'])}}
                                    {{link_to_route('editComment','',$cm->id,['class'=>'edit','title'=>'ویرایش دیدگاه'])}}
                                    {{link_to_route('verifyComment','',$cm->id,['class'=>'verify','title'=>'تأیید دیدگاه'])}}
                                </div>
                            </li>
                        </ul>
                    </div>
                @endforeach
            @else
                <span class="no-text"></span>
            @endif

        </section>
        <section class="last10" data-title="دیدگاه های اخیر">

            @if($last10->count())
                @foreach($last10 as $cm)
                    <?php $posttype = $cm->post()->first()->posttype()->first()->name ?>
                    <?php $hifen = $cm->post()->first()->hifen_title ?>
                    <div class="item">
                        <ul>
                            <li>
                                <div class="detail">
                                    <ul>
                                        <li class="name">{{link_to_route('showComment',$cm->username,$cm->id)}}</li>
                                        <li class="email">{{$cm->email}}</li>
                                    </ul>
                                </div>
                                <div class="text">{{$cm->content}}</div>
                                <div class="actions">
                                    <span class="date">{{toPersianNums($jalali->forge($cm->created_at->timestamp)->format("%H:%M - %A %e %B %Y"))}}</span>
                                    {{link_to_route($posttype,'',$hifen,['class'=>'link-to-post','title'=>'مشاهده پست مرتبط','target'=>'_blank'])}}
                                    {{link_to_route('deleteComment','',$cm->id,['class'=>'delete','title'=>'حذف دیدگاه','onclick'=>'return confirm("آیا از حذف این دیدگاه اطمینان دارید؟")'])}}
                                    {{link_to_route('editComment','',$cm->id,['class'=>'edit','title'=>'ویرایش دیدگاه'])}}

                                </div>
                            </li>
                        </ul>
                    </div>
                @endforeach
            @else
                <span class="no-text"></span>
            @endif

        </section>
    </div>
@endsection