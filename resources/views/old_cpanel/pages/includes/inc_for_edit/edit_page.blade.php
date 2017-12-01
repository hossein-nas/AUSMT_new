<div class="item">
    <p class="input">عنوان مطلبی قصد ارسالش را دارید وارد کنید :</p>
    {!! Form::text('title',$p->title) !!}
    {{--<span class="tooltip">این مکان را باید پر کنید.</span>--}}
</div>

<div class="item">
    <p>محتوای خبر را در کادر زیر وارد کنید :</p>
    {!! Form::textarea('content',$p->content,['id'=>'post_content']) !!}

</div>
