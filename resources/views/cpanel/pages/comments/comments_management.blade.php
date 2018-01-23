@extends('cpanel.layout.master')
@section('title')
    کنترل پنل :: مدیریت دیدگاه ها
@endsection

@section('main-section')
    <div class="ui message column">
        <div class="header">
            <div class="ui breadcrumb ">
                <div class="section"> خانه</div>
                <i class="left chevron icon divider"></i>
                <div class="section">مدیریت دیدگاه‌ها</div>
            </div>
        </div>
    </div>

    <div class="cpanel-comment-area">
        <div class="stats-section">
            <span class="not-verified">
                {{ $all_comments->unverified_count }}
            </span>
            <span class="today">
                {{ $all_comments->today_count }}
            </span>
            <span class="month">
                 {{ $all_comments->month_count }}
            </span>
            <span class="total">
                {{ $all_comments->all_count }}
            </span>
        </div>

        <div class="management-section">

            <section class="header">مدیریت دیدگاه‌ها</section>

            @if ( $all_comments->count() > 0 )
                @foreach( $all_comments as $cm )
                    <div class="item" data-cm-id="{{$cm->id}}" data-cm-name="{{$cm->name}}"
                         data-cm-verified="{{ $cm->verified }}"
                         data-cm-data="{{ $cm->toJson() }}"
                         id="{{ 'cm-'.$cm->id }}"
                    >
                        <div class="header">{{ $cm->name }}</div>
                        <div class="body">{{ $cm->content }}</div>
                        @if( !$cm->verified )
                            <div class="verification">
                                این دیدگاه تأیید نشده. تأیید میکنید؟
                                <i class="ui icon checkmark"></i>
                            </div>
                        @endif
                        <div class="footer">
                            <div class="date">
                                {{ toPersianNums($jalali->forge($cm->created_at)->format('%y/%m/%d - H:i:s')) }}
                            </div>
                            <span class="more-detail">جزئیات بیشتر</span>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>

@endsection


@section('scripts')

@endsection