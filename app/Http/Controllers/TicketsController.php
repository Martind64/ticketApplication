<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\TicketFormRequest;

use App\Http\Requests;

class TicketsController extends Controller
{
    public function ticket()
	{
		return view ('tickets.create');
	}

	public function store(TicketFormRequest $request)
	{
	}
}
