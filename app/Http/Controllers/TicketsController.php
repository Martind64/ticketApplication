<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\TicketFormRequest;
use App\Ticket;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests;

class TicketsController extends Controller
{
    public function ticket()
	{
		return view ('tickets.create');
	}

	public function store(TicketFormRequest $request)
	{
		$slug = uniqid();
		$ticket = new Ticket (array(
		
			'title' => $request->get('title'),
			'content' => $request->get('content'),
			'slug' => $slug
		));

		$ticket->save();

		$data = array('ticket' => $slug);

		Mail::send('emails.ticket', $data, function($message)
		{
			$message->from('devdelfs@gmail.com', 'The title?');

			$message->to('devdelfs@gmail.com')->subject('there is a new ticket');
		});

		return redirect('/ticket')->with('status', 'Your ticket has been created! Its unique id is:'.$slug );
	}

	public function index()
	{
		$tickets = Ticket::all();
		return view('tickets.index', ['tickets' => $tickets ]);
	}

	public function show($id)
	{
		$ticket = Ticket::whereId($id)->firstOrFail();

		$comments = $ticket->comments()->get();

		return view('tickets.show', [
			'ticket' => $ticket,
			'comments' => $comments,
			]);
	}

	public function edit($id)
	{
		$ticket = Ticket::whereId($id)->firstOrFail();

		return view('tickets.edit', ['ticket' => $ticket]);
	}

	public function update($id, TicketFormRequest $request)
	{
		$ticket = Ticket::whereId($id)->firstOrFail();

		$ticket->title = $request->get('title');
		$ticket->content = $request->get('content');

		if($request->get('status') != null)
		{
			$ticket->status = 0;
		}
		else
		{
			$ticket->status = 1;
		}
		$ticket->save();

		return redirect(action('TicketsController@edit', $ticket->id))->with('status', 'the ticket '.$id.' has been updated');
	}

	public function destroy($id)
	{
		$ticket = Ticket::whereId($id)->firstOrFail();
		$ticket->delete();
		return redirect('/tickets')->with('status', 'the ticket'.$id.'has been deleted');
	}
}
