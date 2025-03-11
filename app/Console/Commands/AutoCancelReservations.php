<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ReservationController;
use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Support\Facades\Log;

class AutoCancelReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:auto-cancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically cancel expired reservations';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expiredReservations = Reservation::where('reservationStatus', 'On Going')
            ->whereRaw("TIMESTAMP(reservationDate, reservationTime) < ?", [Carbon::now()->subMinutes(29)->format('Y-m-d H:i:s')]) // ini buat set auto cancelnya kl dah expired brp lama
            ->get();

        $count = 0;

        foreach ($expiredReservations as $reservation) {
            $reservation->reservationStatus = 'Cancelled';
            $reservation->save();
            $count++;
        }

        // Log hasilnya
        Log::info("Auto cancel job executed. Data : " . $expiredReservations);
    }
}
