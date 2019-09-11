<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian">
            @foreach($categories as $cate)
                @if($cate->parent_id == '0')
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordian" href="#{{ $cate->name }}">
                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>{{ $cate->name }}
                                </a>
                            </h4>
                        </div>
                        <div id="{{ $cate->name }}" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    @foreach($categories as $child)
                                        @if($child->parent_id == $cate->id)
                                            <li><a href="{{ URL::to('categoryProducts/'.$child->id) }}">{{ $child->name }}</a></li>
                                        {{--@else
                                            <li><a href="{{ URL::to('categoryProducts/'.$cate->id) }}">{{ $cate->name }}</a></li>
                                            @break;--}}
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
