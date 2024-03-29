<?php

namespace App\Services;

use App\Interface\TicketInterface;

class TicketService
{
    protected TicketInterface $ticketInterface;

    public function __construct(TicketInterface $ticketInterface)
    {
        $this->ticketInterface = $ticketInterface;
    }

    public function getTickets(int $limit)
    {
        return $this->ticketInterface->getTickets($limit);
    }

    public function getDeletedTickets(int $limit)
    {
        return $this->ticketInterface->getDeletedTickets($limit);
    }

    public function restoreTicket(int $id)
    {
        return $this->ticketInterface->restoreTicket($id);
    }

    public function viewTicket(int $id)
    {
        return $this->ticketInterface->viewTicket($id);
    }

    public function storeTicket(array $data)
    {
        $data['created_by'] = auth()->id();
        return $this->ticketInterface->storeTicket($data);
    }

    public function updateTicket(array $data, $id)
    {
        return $this->ticketInterface->updateTicket($data, $id);
    }

    public function delete($id)
    {
        return $this->ticketInterface->delete($id);
    }
}