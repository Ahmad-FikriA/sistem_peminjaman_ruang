<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingsExport implements FromCollection,WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;
    protected $roomId;
    protected $userId;

    public function __construct($startDate, $endDate, $roomId, $userId)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->roomId = $roomId;
        $this->userId = $userId;
    }

    public function collection()
    {
        $query = Booking::query()->with(['room', 'user']);

        // Apply filters
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('start_date', [$this->startDate, $this->endDate]);
        }

        if ($this->roomId) {
            $query->where('room_id', $this->roomId);
        }

        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }

        return $query->get();
    }
    public function headings(): array
    {
        return [
            'ID',
            'Room Name',
            'User Name',
            'Start Date',
            'End Date',
            'Created At',
            'Updated At',
        ];
    }
    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->room->name,
            $booking->user->name,
            $booking->start_date,
            $booking->end_date,
            $booking->created_at,
            $booking->updated_at,
        ];
    }
}