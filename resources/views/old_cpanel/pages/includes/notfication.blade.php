@if($allPosts['notfication']->count())
    @foreach($allPosts['notfication'] as $notfication)
        <div class="spec-post-table">
            <section class="first-section">
                <a href="{{route('notfication',$notfication->hifen_title)}}" target="_blank">{{$notfication->title}}</a>
                <section class="setting">
                    <ul>
                        <li><a href="{{route('notfication',$notfication->hifen_title)}}"    target="_blank"
                               class="fa-external-link" title="مشاهده خبر"></a></li>
                        <li><a href="/admin-panel/hide/{{$notfication->hifen_title}}/"      class="fa-lock "
                               title="مخفی کردن"></a></li>
                        <li><a href="/admin-panel/edit/{{$notfication->hifen_title}}/"      class="fa-pencil-square "
                               title="ویرایش خبر"></a></li>
                        <li><a href="/admin-panel/delete/{{$notfication->hifen_title}}/"    class="fa-trash"
                               title="حذف خبر"></a></li>
                    </ul>
                </section>
            </section>
            <section class="second-section">
                <table>
                    <tr>
                        <td>شماره خبر :</td>
                        <td>#{{$notfication->id}}</td>
                    </tr>
                    <tr>
                        <td>در تاریخ :</td>

                        <td>{{$jalali->forge($notfication->created_at->timestamp)->format("%A %e %B %Y")}}</td>
                    </tr>
                    <tr>
                        <td>ارسال شده توسط :</td>
                        <td>{{$notfication->user->name}}</td>
                    </tr>
                </table>
            </section>
        </div>
    @endforeach
@else
    <span class="no-text"></span>
@endif