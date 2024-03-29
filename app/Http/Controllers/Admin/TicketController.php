<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Services\TicketService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    protected TicketService $ticketService;
    protected UserService $userService;

    public function __construct(TicketService $ticketService, UserService $userService)
    {
        $this->ticketService = $ticketService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit', 2);
        $tickets = $this->ticketService->getTickets($limit);
        return view('admin.ticket.index')->with('tickets', $tickets);
    }

    public function deletedIndex(Request $request)
    {
        $limit = $request->get('limit', 2);
        $tickets = $this->ticketService->getDeletedTickets($limit);
        return view('admin.ticket.deleted-index')->with('tickets', $tickets);
    }

    public function restoreTicket(int $id)
    {
        $this->ticketService->restoreTicket($id);
        return redirect()->route('admin.ticket.index')->with('status', 'Ticket restored successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createTicket(): \Illuminate\Contracts\View\View
    {
        $staffs = $this->userService->getStaffs();
        return view('admin.ticket.form')->with('staffs', $staffs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTicket(TicketRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->ticketService->storeTicket(
            $request->only('title', 'description', 'status', 'assigned_user', 'due_date')
        );
        return redirect()->to('/admin/tickets')->with('status', 'Ticket Created');
    }

    /**
     * Display the specified resource.
     */
    public function viewTicket(int $id)
    {
        $ticket = $this->ticketService->viewTicket($id);
        return view('admin.ticket.details')->with('ticket', $ticket);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editTicket(int $id)
    {
        $staffs = $this->userService->getStaffs();
        $ticket = $this->ticketService->viewTicket($id);
        return view('admin.ticket.form')->with(['ticket' => $ticket, 'staffs' => $staffs]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTicket(TicketRequest $request, int $id)
    {
        $ticket = $this->ticketService->updateTicket(
            $request->only('title', 'description', 'assigned_user', 'status', 'due_date'),
            $id
        );
        return redirect()->to('/admin/tickets')->with('status', 'Ticket Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->ticketService->delete($id);
        return redirect('/admin/tickets')->with('status', 'Ticket Deleted');
    }
}
