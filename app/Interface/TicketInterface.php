<?php

namespace App\Interface;

use App\Models\Ticket;

interface TicketInterface
{

    public function getTickets(int $limit);

    public function getDeletedTickets(int $limit);

    public function restoreTicket(int $id);

    public function viewTicket(int $id);

    public function storeTicket($data);

    public function updateTicket($data, int $id);

    public function delete($id);
}