@if($allPosts['incoming']->count())
    @foreach($allPosts['incoming'] as $incoming)
        @if($incoming->expired_at->gte(Carbon\Carbon::now()))
        <div class="spec-post-table active">
        @else
            <div class="spec-post-table deactive">
        @endif
            <section class="first-section">
                <a href="/incoming/{{$incoming->hifen_title}}" target="_blank">{{$incoming->title}}</a>
                <section class="setting">
                    <ul>
                        <li><a href="/incoming/{{$incoming->hifen_title}}" target="_blank" class="fa-external-link"
                               title="مشاهده خبر"></a></li>
                        <li><a href="/admin-panel/hide/{{$incoming->hifen_title}}/" class="fa-lock "
                               title="مخفی کردن"></a></li>
                        <li><a href="/admin-panel/edit/{{$incoming->hifen_title}}/" class="fa-pencil-square "
                               title="ویرایش خبر"></a></li>
                        <li><a href="/admin-panel/delete/{{$incoming->hifen_title}}/" class="fa-trash"
                               title="حذف خبر"></a></li>
                    </ul>
                </section>
            </section>
            <section class="second-section">
                <table>
                    <tr>
                        <td>شماره خبر :</td>
                        <td>#{{$incoming->id}}</td>
                    </tr>
                    <tr>
                        <td>ثبت شده در تاریخ :</td>

                        <td>{{$jalali->forge($incoming->created_at->timestamp)->format("%A %e %B %Y")}}</td>
                    </tr>
                    <tr>
                        <td>منقضی شده در :</td>
                        <td>{{$jalali->forge($incoming->expired_at->timestamp)->format("%A %e %B %Y")}}</td>
                    </tr>
                </table>
            </section>
        </div>
    @endforeach
@else
    <span class="no-text"></span>
@endif
