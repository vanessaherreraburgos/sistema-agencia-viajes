
<div id="{{$id}}" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content bordeado">
			<div class="modal-header titulo-modal">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">{{$title}}</h4>
			</div>
			<div class="modal-body">
				{{$body}}
			</div>
			<div class="modal-footer">
				{{$footer}}
			</div>
		</div>
	</div>
</div>