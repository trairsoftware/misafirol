<div class="col-5 col-md-2 btn btn-success rounded text-center  p-3 p-md-2 d-flex align-items-center justify-content-center {{isset($btnClass) ? $btnClass : 'btn-success'}}"
    style="height:70px">
    <a href="{{$url}}" class="text-white" style=" text-decoration: none; {{isset($aStyle) ? $aStyle : ''}}">{{$title}}
        @isset($count)
        ({{$count}})
        @endisset
    </a>
</div>