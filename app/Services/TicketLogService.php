<?php

namespace App\Services;

use App\Interface\TicketLogInterface;
use App\Models\Ticket;

class TicketLogService
{

    protected TicketLogInterface $ticketLogInterface;

    public function __construct(TicketLogInterface $ticketLogInterface)
    {
        $this->ticketLogInterface = $ticketLogInterface;
    }

    public function storeTicketLog($ticketId, $comment, $previousStatus, $currentStatus)
    {
        $data = [
            'ticket_id' => $ticketId,
            'user_id' => auth()->id(),
            'comment' => $comment,
            'previous_status' => $previousStatus,
            'current_status' => $currentStatus
        ];
        return $this->ticketLogInterface->store($data);
    }

}