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
		</div>


@endsection