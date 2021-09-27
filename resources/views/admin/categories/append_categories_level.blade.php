
<div class="form-group">
    <label>Select Category Level</label>
  <select name="parent_id" id="parent_id" class="form-control select2" style="width: 100%;">
    <option value="0"
    @if (isset($categorydata['parent_id']) && $categorydata['parent_id']== 0 )
    selected =""
    @endif
    >Main Category</option>
    @if (!empty($getCategories))
        @foreach ($getCategories as $getCategory )
            <option value="{{ $getCategory['id'] }}"
            @if (isset($categorydata['parent_id']) && $categorydata['parent_id']== $getCategory->id )
            selected =""
            @endif
            >{{ $getCategory['category_name'] }}</option>
            @if (!empty($getCategory['subcategories']))
                @foreach ($getCategory['subcategories'] as $subcategory)
                    <option value="{{ $subcategory['id'] }}"
                    @if (isset($categorydata['parent_id']) && $categorydata['parent_id']== $subcategory->id )
                    selected =""
                    @endif
                    >&nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option>
                @endforeach
            @endif
        @endforeach
    @endif
    </select>
</div>
