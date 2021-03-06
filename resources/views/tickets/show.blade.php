@extends('master');
@section('title', 'Show ticket')

@section('content')

<div class="container col-md-8 col-md-offset-2">
	<div class="well well bs-component">
	<div class="content">
		<h2 class="header">{!! $ticket->title !!}</h2>
		<p> <strong>Status:</strong>: {!! $ticket->status ? 'Pending' : 'Answered' !!}</p>
		<p><b>Content:	</b> {!! $ticket->content !!} </p>
	</div>
		<a href="{!! action('TicketsController@edit', $ticket->id) !!}" class="btn btn-info pull-left">Edit</a>
		<form method="post" action="{!! action('TicketsController@destroy', $ticket->id) !!}" class="pull-left">
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div>
					<button type="submit" class="btn btn-warning">Delete</button>
				</div>
		</form>
		<div class="clearfix"></div>
			</div>



	<!-- Show all comments -->
	@foreach($comments as $comment)
		<div class="well well bs-component">
			<div class="content">
				{!! $comment->content !!}
			</div>
			
		</div>
	@endforeach



	<!-- Reply form -->

	<div class="well well bs-component">
	<form class="form-horizontal" method="post" action="/comment">
	
		@foreach($errors->all() as $error)
			<p class="alert alert-danger">{{ $error }}</p>
		@endforeach

		@if(session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif
		
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
		<input type="hidden" name="post_id" value="{!! $ticket->id !!}">
		
		<fieldset>
			<legend>Reply</legend>
			
			<div class="form-group">
				<div class="col-lg-12">
					<textarea class="form-control" rows="3" id="content" name="content"></textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="col-lg-10">
					<button type="reset" class="btn btn-default">Cancel</button>
					<button type="submit" class="btn btn-primary">Post</button>
				</div>
			</div>
		</fieldset>
	</form>
</div>
</div>





@endsection