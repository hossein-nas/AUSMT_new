<div class="item">
    <p class="input">عنوان مطلبی قصد ارسالش را دارید وارد کنید :</p>
    {!! Form::text('title',$p->title) !!}
    {{--<span class="tooltip">این مکان را باید پر کنید.</span>--}}
</div>

<div class="item">
    <p>محتوای خبر را در کادر زیر وارد کنید :</p>
    {!! Form::textarea('content',$p->content,['id'=>'post_content']) !!}

</div>
<div class="item upload-image">
    {!! Form::label('name','َعکس خود را انتخاب کنید:') !!}
    {!! Form::file('post_image',['id'=>'file']) !!}
    {!! Form::hidden('image',$p->image,['id'=>'image']) !!}
    {!! Form::hidden('destPath','slideshow/_other/',['id'=>'destPath']) !!}

    <div id="uploaded-image">
        <img src="{{asset($p->image)}}" alt="{{$p->title}}">
    </div>
    <div id="open-window">انتخاب تصویر</div>
    <div id="upload-image">
        آپلود تصویر
        {{--<span class="percent">89</span>--}}
    </div>
</div>
