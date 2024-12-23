<div class="sub-cat-main row no-gutters">
    <div class="col-12">
        <div class="sub-cat-content">
            <div class="sub-cat-list">
                <div class="card-columns">
                    @forelse ($subcategories as $item)
                    <div class="card">
                        <ul class="sub-cat-items">
                            <li class="sub-cat-name"><a class=" text-capitalize"
                                    href="{{ url('category/' . $item->slug) }}">
                                    {{$item->category_name}}</a></li>
                        </ul>
                    </div>
                    @empty
    
                    @endforelse
             
                </div>
            </div>
        </div>
    </div>
</div>
