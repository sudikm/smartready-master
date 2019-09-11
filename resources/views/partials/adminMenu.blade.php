@if($linkData)
    <h3 class="page-title">{{ $page_title }}</h3>
    <ul class="breadcrumb">
        @foreach($linkData as $key=>$link)
            <li>
                <i class="icon-{{ $key }}"></i>
                <a href="{{ URL::to($link) }}" style="text-transform: uppercase;">@if($key == 'shopping-cart')
                        Products @else{{ $key }} @endif</a>
                <i class="icon-angle-right"></i>
            </li>
        @endforeach
        <li style="float: right;">
            <i class="fa fa-sign-out"></i>
            <a href="{{ URL::to('admin/logoutAdminUser') }}">LOGOUT</a>
        </li>
    </ul>
@endif