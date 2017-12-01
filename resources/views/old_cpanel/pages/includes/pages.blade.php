@if($allPosts['page']->count())
    @foreach($allPosts['page'] as $page)
        <div class="spec-post-table">
            <section class="first-section">
                <a href="{{route('page',$page->hifen_title)}}" target="_blank">{{$page->title}}</a>
                <section class="setting">
                    <ul>
                        <li ><a href="{{route('page',$page->hifen_title)}}" target="_blank" class="fa-external-link" title="مشاهده خبر"></a></li>
                        <li ><a href="/admin-panel/hide/{{$page->hifen_title}}/" class="fa-lock "  title="مخفی کردن"></a ></li>
                        <li ><a href="/admin-panel/edit/{{$page->hifen_title}}/" class="fa-pencil-square "  title="ویرایش خبر"></a></li>
                        <li ><a href="/admin-panel/delete/{{$page->hifen_title}}/" class="fa-trash"  title="حذف خبر"></a></li>
                    </ul>
                </section>
            </section>
            <section class="second-section">
                <table>
                    <tr>
                        <td>شماره خبر : </td>
                        <td>#{{$page->id}}</td>
                    </tr>
                    <tr>
                        <td>در تاریخ :</td>

                        <td>{{$jalali->forge($page->created_at->timestamp)->format("%A %e %B %Y")}}</td>
                    </tr>
                    <tr>
                        <td>ارسال شده توسط :</td>
                        <td>{{$page->user->name}}</td>
                    </tr>
                </table>
            </section>
        </div>
    @endforeach
@else
    <span class="no-text"></span>
@endif

