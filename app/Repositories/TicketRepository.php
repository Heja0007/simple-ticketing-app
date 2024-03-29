<?php

namespace App\Repositories;

use App\Interface\TicketInterface;
use App\Models\Ticket;

class TicketRepository implements TicketInterface
{
    protected Ticket $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function getTickets(int $limit)
    {
        return $this->ticket
            ->with([
                'assignedUser' => function ($query) {
                    $query->select('id', 'name');
                },
                'createdBy' => function ($query) {
                    $query->select('id', 'name');
                }
            ])->orderBy('id', 'desc')
            ->paginate($limit);
    }

    public function getDeletedTickets(int $limit)
    {
        return $this->ticket->onlyTrashed()
            ->with([
                'assignedUser' => function ($query) {
                    $query->select('id', 'name');
                },
                'createdBy' => function ($query) {
                    $query->select('id', 'name');
                }
            ])->orderBy('deleted_at', 'desc')
            ->paginate($limit);
    }

    public function restoreTicket(int $id)
    {
        return $this->ticket->onlyTrashed()->findOrFail($id)->restore();
    }

    public function viewTicket(int $id)
    {
        return $this->ticket->withTrashed()
            ->with([
                'assignedUser' => function ($query) {
                    $query->select('id', 'name');
                },
                'createdBy' => function ($query) {
                    $query->select('id', 'name');
                },
                'ticketLogs'
            ])->findOrFail($id);
    }

    public function storeTicket($data)
    {
        return $this->ticket->create($data);
    }

    public function updateTicket($data, $id)
    {
        $ticket = $this->ticket->findOrFail($id);
        return $ticket->update($data);
    }

    public function delete($id)
    {
        $ticket = $this->ticket->findOrFail($id);
        return $ticket->delete();
    }
}