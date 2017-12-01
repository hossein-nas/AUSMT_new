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
	{!! Form::hidden('destPath','slideshow/_post/',['id'=>'destPath']) !!}
	<div id="uploaded-image">
		<img src="{{asset($p->image)}}" alt="{{$p->title}}">
	</div>
	<div id="open-window">انتخاب تصویر</div>
	<div id="upload-image">
		آپلود تصویر
		{{--<span class="percent">89</span>--}}
	</div>
</div>
<div class="checkbox block">
	<?php
	if ($p->priority)
		$priority = ['checked' => 'checked'];
	else
		$priority = [];
	if ($p->addToSlider)
		$addToSlider = ['checked' => 'checked'];
	else
		$addToSlider = [];
	?>
	<label for="radiobtn">
		{!! Form::checkbox('priority',null,$priority) !!}
		آیا خبر مهم ای است؟
	</label>
</div>
<div class="checkbox block sep">
	<label for="radiobtn">
		{!! Form::checkbox('addToSlider',null , $addToSlider) !!}
		به اسلاید شو اضافه شود؟
	</label>
</div>