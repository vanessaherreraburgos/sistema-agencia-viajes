	<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2 class="letra-azul-negrita">{{array_last($breadcrumbs)}}</h2>
            <ol class="breadcrumb">
                @foreach($breadcrumbs as $index => $value)
                    @if($loop->last)
                        <li class="active">
                            <strong>{{$value}}</strong>
                        </li>
                    @else
                        <li>
                            <a href="{{url($index)}}">{{$value}}</a>
                        </li>  
                    @endif
                @endforeach
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>