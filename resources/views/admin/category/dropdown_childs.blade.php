@foreach($childs as $child)

    <option value="{{ $child->id }}" {{!empty($category->parent_id) && $category->parent_id==$child->id?'selected':''}}>
        @for ($i = 0; $i <= $level; $i++)
            -
        @endfor
        {{ $child->category_name }}</option>

    @if(count($child->childs))

        @include('admin.category.dropdown_childs',['childs' => $child->childs,'level'=>($level+1),'category'=>!empty($category) && $category?$category:[]])

    @endif

@endforeach
