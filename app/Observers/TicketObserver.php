<?php

namespace App\Observers;

use App\Models\Ticket;
use App\Services\TicketLogService;
use Illuminate\Support\Facades\Log;

class TicketObserver
{
    protected TicketLogService $ticketLogService;

    public function __construct(TicketLogService $ticketLogService)
    {
        $this->ticketLogService = $ticketLogService;
    }

    public function created(Ticket $ticket): void
    {
        Log::info('created');
        try {
            $ticketId = $ticket['id'];
            $comment = auth()->user()->name . ' created ticket: ' . $ticketId;
            $previousStatus = '';
            $currentStatus = $ticket['status'];
            $this->ticketLogService->storeTicketLog($ticketId, $comment, $previousStatus, $currentStatus);
        } catch (\Exception $exception) {
            Log::error('ticket_observer_created_error', [
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString()
            ]);
        }
    }

    public function updated(Ticket $ticket): void
    {
        Log::info('updated');
        try {
            $changes = $ticket->getChanges();
            $user = auth()->user()->name;
            $ticketId = $ticket['id'];
            $comment = '';
            $previousStatus = $ticket['status'];
            $currentStatus = $ticket['status'];
            if (array_key_exists('status', $changes)) {
                $previousStatus = $ticket->getOriginal('status');
                $comment .= $user . ' changed  status from ' . $previousStatus . ' to ' . $changes['status'] . '. ';
            }
            if (array_key_exists('assigned_user', $changes)) {
                if ($changes['assigned_user_id'] === null) {
                    $comment .= $user . '  removed the assigned User. ';
                } else {
                    $oldAssignedUser = $ticket->getOriginal('assigned_user');
                    $comment .= $user . '  changed  the assigned user from ' . $oldAssignedUser . ' to ' . $changes['assigned_user'] . '. ';
                }
            }
            if (array_key_exists('due_date', $changes)) {
                $oldDueDate = $ticket->getOriginal('due_date');
                if (!$oldDueDate) {
                    $comment .= $user . ' added ticket due date to' . $ticket['due_date'] . '. ';
                } else {
                    $comment .= $user . 'changed the due date from ' . $oldDueDate . ' to ' . $changes['due_date'] . '. ';
                }
            }

            if ($comment !== '') {
                $comment = $user . ' updated ticket: ' . $ticketId . '. ' . $comment;
                $this->ticketLogService->storeTicketLog($ticketId, $comment, $previousStatus, $currentStatus);
            }
        } catch (\Exception $exception) {
            Log::error('ticket_observer_updated_error', [
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString()
            ]);
        }
    }

    public function deleted(Ticket $ticket): void
    {
        try {
            $user = auth()->user()->name;
            $ticketId = $ticket['id'];
            $comment = $user . ' deleted ticket id:' . $ticketId;
            $previousStatus = $ticket['status'];
            $currentStatus = 'Deleted';
            $this->ticketLogService->storeTicketLog($ticketId, $comment, $previousStatus, $currentStatus);
        } catch (\Exception $exception) {
            Log::error('ticket_observer_deleted_error', [
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString()
            ]);
        }
    }

    public function restored(Ticket $ticket): void
    {
        try {
            $user = auth()->user()->name;
            $ticketId = $ticket['id'];
            $comment = $user . ' restored ticket id:' . $ticketId;
            $previousStatus = 'Deleted';
            $currentStatus = 'Restored';
            $this->ticketLogService->storeTicketLog($ticketId, $comment, $previousStatus, $currentStatus);
        } catch (\Exception $exception) {
            Log::error('ticket_observer_restored_error', [
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString()
            ]);
        }
    }
}
