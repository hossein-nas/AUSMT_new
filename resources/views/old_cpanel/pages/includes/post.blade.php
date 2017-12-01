

@if($allPosts['post']->count())
    @foreach($allPosts['post'] as $post)
        <div class="spec-post-table">
            <section class="first-section">
                <a href="{{route('post',$post->hifen_title)}}" target="_blank">{{$post->title}}</a>
                <section class="setting">
                    <ul>
                        <li ><a href="{{route('post',$post->hifen_title)}}" target="_blank" class="fa-external-link" title="مشاهده خبر"></a></li>
                        <li ><a href="/admin-panel/hide/{{$post->hifen_title}}/" class="fa-lock "  title="مخفی کردن"></a ></li>
                        <li ><a href="/admin-panel/edit/{{$post->hifen_title}}/" class="fa-pencil-square "  title="ویرایش خبر"></a></li>
                        <li ><a href="/admin-panel/delete/{{$post->hifen_title}}/" class="fa-trash"  title="حذف خبر"></a></li>
                    </ul>
                </section>
            </section>
            <section class="second-section">
                <table>
                    <tr>
                        <td>شماره خبر : </td>
                        <td>#{{$post->id}}</td>
                    </tr>
                    <tr>
                        <td>در تاریخ :</td>

                        <td>{{$jalali->forge($post->created_at->timestamp)->format("%A %e %B %Y")}}</td>
                    </tr>
                    <tr>
                        <td>ارسال شده توسط :</td>
                        <td>{{$post->user->name}}</td>
                    </tr>
                </table>
            </section>
        </div>
    @endforeach
@else
    <span class="no-text"></span>
@endif

{{--<div class="spec-post-table">--}}
{{--<section class="first-section">--}}
{{--<a href="#">آیفون از فروشگاه های ایران جمع می‌شود</a>--}}
{{--<section class="setting">--}}
{{--<ul>--}}
{{--<li ><a href="#" class="fa-external-link" title="مشاهده خبر"></a></li>--}}
{{--<li ><a href="#" class="fa-lock "  title="مخفی کردن"></a ></li>--}}
{{--<li ><a href="#" class="fa-pencil-square "  title="ویرایش خبر"></a></li>--}}
{{--<li ><a href="#" class="fa-trash"  title="حذف خبر"></a></li>--}}
{{--</ul>--}}
{{--</section>--}}
{{--</section>--}}
{{--<section class="second-section">--}}
{{--<table>--}}
{{--<tr>--}}
{{--<td>شماره خبر : </td>--}}
{{--<td>6565</td>--}}
{{--</tr>--}}
{{--<tr>--}}
{{--<td>در تاریخ :</td>--}}
{{--<td>3 بهمن 1395 - 23:45</td>--}}
{{--</tr>--}}
{{--<tr>--}}
{{--<td>ارسال شده توسط :</td>--}}
{{--<td>حسین نصیری صوری</td>--}}
{{--</tr>--}}
{{--</table>--}}
{{--</section>--}}
{{--</div>--}}


{{--<section class="pagination">--}}
    {{--<div>--}}
        {{--<ul>--}}
            {{--<li ><a href="#" class="fa fa-chevron-left "></a></li>--}}
            {{--<li><a href="#">۱</a></li>--}}
            {{--<li><a href="#">۲</a></li>--}}
            {{--<li><a href="#">۳</a></li>--}}
            {{--<li><a href="#">۴</a></li>--}}
            {{--<li class="minus">...</li>--}}
            {{--<li><a href="#">۹</a></li>--}}
            {{--<li><a href="#">۱۰</a></li>--}}
            {{--<li ><a href="#" class="fa fa-chevron-right "></a></li>--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--</section>--}}