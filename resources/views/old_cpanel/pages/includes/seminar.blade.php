@if($allPosts['seminar']->count())
    @foreach($allPosts['seminar'] as $seminar)
        <div class="spec-post-table">
            <section class="first-section">
                <a href="{{route('seminar',$seminar->hifen_title)}}" target="_blank">{{$seminar->title}}</a>
                <section class="setting">
                    <ul>
                        <li ><a href="{{route('seminar',$seminar->hifen_title)}}" target="_blank" class="fa-external-link" title="مشاهده خبر"></a></li>
                        <li ><a href="/admin-panel/hide/{{$seminar->hifen_title}}/" class="fa-lock "  title="مخفی کردن"></a ></li>
                        <li ><a href="/admin-panel/edit/{{$seminar->hifen_title}}/" class="fa-pencil-square "  title="ویرایش خبر"></a></li>
                        <li ><a href="/admin-panel/delete/{{$seminar->hifen_title}}/" class="fa-trash"  title="حذف خبر"></a></li>
                    </ul>
                </section>
            </section>
            <section class="second-section">
                <table>
                    <tr>
                        <td>شماره خبر : </td>
                        <td>#{{$seminar->id}}</td>
                    </tr>
                    <tr>
                        <td>در تاریخ :</td>

                        <td>{{$jalali->forge($seminar->created_at->timestamp)->format("%A %e %B %Y")}}</td>
                    </tr>
                    <tr>
                        <td>ارسال شده توسط :</td>
                        <td>{{$seminar->user->name}}</td>
                    </tr>
                </table>
            </section>
        </div>
    @endforeach
@else
    <span class="no-text"></span>
@endif