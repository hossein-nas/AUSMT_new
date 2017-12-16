<div class="item {{$cat->removable? 'removable' : ''}}">
    <i class="ui icon"></i>
    <div class="content">
        <div class="header">
        <div class="ui checkbox file_categories" data-id="{{$cat->id}}" data-dir-name="{{ $cat->dir_name }}" data-removable="{{ $cat->removable }}" data-description="{{ $cat->description }}" data-parent-category="{{ $cat->parent_category_id }}" data-base-path="{{ $cat->base_dir_path }}" data-parent-cat-name="@if ( $cat->parent_cat)  {{$cat->parent_cat->name}} @endif">
            <input name="example" type="checkbox">
            <label>{{ $cat->name }}</label>
        </div>
        </div>
        @if ( count($cat->childs) > 0 )
            <div class="list divided">
                @foreach($cat->childs as $cat)
                    @include('cpanel.pages.files.includes.recursive_category_list')
                @endforeach
            </div>
        @endif
    </div>
</div>
