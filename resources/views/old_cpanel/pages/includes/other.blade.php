@if($allPosts['other']->count())
    @foreach($allPosts['other'] as $other)
        <div class="spec-post-table">
            <section class="first-section">
                <a href="{{route('other',$other->hifen_title)}}" target="_blank">{{$other->title}}</a>
                <section class="setting">
                    <ul>
                        <li ><a href="{{route('other',$other->hifen_title)}}" target="_blank" class="fa-external-link" title="مشاهده خبر"></a></li>
                        <li ><a href="/admin-panel/hide/{{$other->hifen_title}}/" class="fa-lock "  title="مخفی کردن"></a ></li>
                        <li ><a href="/admin-panel/edit/{{$other->hifen_title}}/" class="fa-pencil-square "  title="ویرایش خبر"></a></li>
                        <li ><a href="/admin-panel/delete/{{$other->hifen_title}}/" class="fa-trash"  title="حذف خبر"></a></li>
                    </ul>
                </section>
            </section>
            <section class="second-section">
                <table>
                    <tr>
                        <td>شماره خبر : </td>
                        <td>#{{$other->id}}</td>
                    </tr>
                    <tr>
                        <td>در تاریخ :</td>

                        <td>{{$jalali->forge($other->created_at->timestamp)->format("%A %e %B %Y")}}</td>
                    </tr>
                    <tr>
                        <td>ارسال شده توسط :</td>
                        <td>{{$other->user->name}}</td>
                    </tr>
                </table>
            </section>
        </div>
    @endforeach
@else
    <span class="no-text"></span>
@endif