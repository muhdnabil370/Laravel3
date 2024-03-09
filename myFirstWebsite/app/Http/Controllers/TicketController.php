<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Notifications\TicketUpdateNotification;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $tickets = $user->isAdmin ? Ticket::orderBy('created_at', 'desc')->get() : $user->tickets;
        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            // 'attachment' =>
            'user_id' => auth()->id(),
        ]);

        if ($request->file('attachment')) {

            $this->storeAttachment($request, $ticket);

            // $ext = $request->file('attachment')->extension();
            // $contents = file_get_contents($request->file('attachment'));
            // $filename = Str::random(25);
            // $path = "attachment/$filename.$ext";
            // Storage::disk('public')->put($path, $contents);
            // $ticket->update(['attachment' => $path]);
        }

        return response()->redirectTo(route('ticket.index'));


        // return view('ticket.store');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        // dd($ticket);
        return view('ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        // dd($request->except('status'));
        // $ticket->update($request->validate();) can do this, if atttachment remove from updateticketrequest
        // $ticket->update(['title' => $request->title, 'description' => $request->description]);

        $ticket->update($request->except('attachment')); // update all except attcahemnt

        if($request->has('status')){
            // $user = User::find($ticket->user_id);
            $ticket->user->notify(new TicketUpdateNotification($ticket));
            // return (new TicketUpdateNotification($ticket))->toMail($user);
        }

        if ($request->file('attachment')) {

            Storage::disk('public')->delete($ticket->attachment);

            $this->storeAttachment($request, $ticket);

            // $ext = $request->file('attachment')->extension();
            // $contents = file_get_contents($request->file('attachment'));
            // $filename = Str::random(25);
            // $path = "attachment/$filename.$ext";
            // Storage::disk('public')->put($path, $contents);
            // $ticket->update(['attachment' => $path]);
        }

        return redirect(route('ticket.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect(route('ticket.index'));
    }


    //other method for attachment

protected function storeAttachment($request, $ticket)
{
    $ext = $request->file('attachment')->extension();
    $contents = file_get_contents($request->file('attachment'));
    $filename = Str::random(25);
    $path = "attachment/$filename.$ext";
    Storage::disk('public')->put($path, $contents);
    $ticket->update(['attachment' => $path]);
}

}
