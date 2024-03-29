<?php

namespace App\Repositories;

use App\Interface\TicketLogInterface;
use App\Models\TicketLog;

class TicketLogRepository implements TicketLogInterface
{

    protected TicketLog $ticketLog;

    public function __construct(TicketLog $ticketLog)
    {
        $this->ticketLog = $ticketLog;
    }

    public function store($data)
    {
        $this->ticketLog->create($data);
    }


}