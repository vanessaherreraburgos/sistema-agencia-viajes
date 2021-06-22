<div class="table-responsive">
	<table id="{{$id}}" class="table table-striped table-bordered table-hover" >
        <thead>
	        <tr>
               	@foreach($headers as $index => $value)
	                <th class="fuente_azul">{{$value}}</th>
	            @endforeach
	        </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
	        <tr>
	            @foreach($headers as $index => $value)
	                <th>{{$value}}</th>
	            @endforeach
	        </tr>
        </tfoot>
    </table>
</div>