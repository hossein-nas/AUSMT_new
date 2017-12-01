<div class="item">
    <p class="input">عنوان پیشآمد را در کار زیر وارد کنید:</p>
    {!! Form::text('title',$p->title) !!}
    {{--<span class="tooltip">این مکان را باید پر کنید.</span>--}}
</div>

<div class="item">
    <p>محتوای پیشآمد را در کادر زیر وارد کنید :</p>
    {!! Form::textarea('content',$p->content,['id'=>'post_content']) !!}

</div>
<div class="date">
    <?php
        $date=\Morilog\Jalali\jDate::forge($p->expired_at);
    ?>
        {!! Form::text('year'   ,$date->format('%y')) !!}
        {!! Form::text('month'  ,$date->format('%m')) !!}
        {!! Form::text('day'    ,$date->format('%d')) !!}
</div>