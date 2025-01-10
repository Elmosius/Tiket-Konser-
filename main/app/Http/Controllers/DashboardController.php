<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // -----------------------------------------
        // [1] CHART: Jumlah event per hari (7 hari)
        // -----------------------------------------
        $eventData = Event::where('id_penjual', Auth::id())
            ->selectRaw('DAYNAME(tanggal_mulai) as day, COUNT(*) as count')
            ->where('tanggal_mulai', '>=', now()->subDays(6))
            ->groupBy('day')
            ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->get();

        // Data jumlah user (total terdaftar)
        $registeredUsersCount = User::count();

        // -------------------------------
        // [2] CHART: Penjualan 7 hari
        // -------------------------------
        $salesData = DB::table('detail_pembelian')
            ->join('tiket', 'detail_pembelian.id_tiket', '=', 'tiket.id')
            ->join('event', 'tiket.id_event', '=', 'event.id')
            ->join('pembelian', 'detail_pembelian.id_pembelian', '=', 'pembelian.id')
            ->select(
                DB::raw('DATE(pembelian.created_at) as tanggal'),
                DB::raw('SUM(detail_pembelian.jumlah) as total_tiket_terjual'),
                DB::raw('SUM(detail_pembelian.jumlah * tiket.harga) as total_pendapatan')
            )
            ->where('event.id_penjual', Auth::id())
            ->whereDate('pembelian.created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

        // Olah data agar menampilkan dayName berurutan Monday->Sunday
        $salesChart = collect();
        foreach ($salesData as $item) {
            $dayName = Carbon::parse($item->tanggal)->format('l');
            $salesChart->push([
                'day'                 => $dayName,
                'total_tiket_terjual' => $item->total_tiket_terjual,
                'total_pendapatan'    => $item->total_pendapatan,
            ]);
        }
        // Urutkan Monday->Sunday
        $orderMap = [
            'Monday'    => 1,
            'Tuesday'   => 2,
            'Wednesday' => 3,
            'Thursday'  => 4,
            'Friday'    => 5,
            'Saturday'  => 6,
            'Sunday'    => 7,
        ];
        $salesChart = $salesChart->sortBy(function ($item) use ($orderMap) {
            return $orderMap[$item['day']] ?? 999;
        })->values();

        // Format data chart event
        $chartData = [
            'days'   => $eventData->pluck('day'),
            'counts' => $eventData->pluck('count'),
        ];

        // Format data chart penjualan
        $salesChartData = [
            'days'        => $salesChart->pluck('day'),
            'ticket_sold' => $salesChart->pluck('total_tiket_terjual'),
            'revenue'     => $salesChart->pluck('total_pendapatan'),
        ];

        // ----------------------------
        // [3] CHART: Top 5 Event
        // ----------------------------
        $topEvents = DB::table('detail_pembelian')
            ->join('tiket', 'detail_pembelian.id_tiket', '=', 'tiket.id')
            ->join('event', 'tiket.id_event', '=', 'event.id')
            ->join('pembelian', 'detail_pembelian.id_pembelian', '=', 'pembelian.id')
            ->select(
                'event.id as event_id',
                'event.nama_event as event_name',
                DB::raw('SUM(detail_pembelian.jumlah) as total_tiket_terjual')
            )
            ->where('event.id_penjual', Auth::id())
            ->where('pembelian.status', '1')
            ->groupBy('event.id', 'event.nama_event')
            ->orderByDesc('total_tiket_terjual')
            ->limit(5)
            ->get();

        $topEventChart = [
            'event_names' => $topEvents->pluck('event_name'),
            'ticket_sold' => $topEvents->pluck('total_tiket_terjual'),
        ];

        // -----------------------------------------------------
        // [4] CHART: GABUNGAN (Top 5 Event + tipe tiket laris)
        // -----------------------------------------------------
        $topEventIds = $topEvents->pluck('event_id');

        $eventTicketData = DB::table('detail_pembelian')
            ->join('tiket', 'detail_pembelian.id_tiket', '=', 'tiket.id')
            ->join('event', 'tiket.id_event', '=', 'event.id')
            ->join('pembelian', 'detail_pembelian.id_pembelian', '=', 'pembelian.id')
            ->select(
                'event.id as event_id',
                'event.nama_event as event_name',
                'tiket.nama_tiket as ticket_type',
                DB::raw('SUM(detail_pembelian.jumlah) as total_terjual')
            )
            ->where('event.id_penjual', Auth::id())
            ->where('pembelian.status', '1')
            ->whereIn('event.id', $topEventIds)
            ->groupBy('event.id', 'event.nama_event', 'tiket.nama_tiket')
            ->orderBy('event.id')
            ->get();

        $allEventNames = $topEvents->pluck('event_name');
        $allTicketTypes = $eventTicketData->pluck('ticket_type')->unique()->values();

        $series = [];
        foreach ($allTicketTypes as $tType) {
            $dataPerEvent = [];
            foreach ($allEventNames as $evName) {
                $found = $eventTicketData->first(function ($item) use ($tType, $evName) {
                    return $item->ticket_type === $tType && $item->event_name === $evName;
                });
                $dataPerEvent[] = $found ? (int) $found->total_terjual : 0;
            }

            $series[] = [
                'name' => $tType,
                'data' => $dataPerEvent,
            ];
        }

        $topEventsWithTicketTypesChart = [
            'event_names' => $allEventNames,
            'series'      => $series,
        ];

        // ----------------------------------
        // [USER ONLINE] dari tabel 'sessions'
        // ----------------------------------
        // Kita asumsikan user "online" = user yang last_activity masih <= 15 menit terakhir
        $activeSessions = DB::table('sessions')
            ->select(
                DB::raw("DATE(FROM_UNIXTIME(last_activity)) as date_aktif"), 
                DB::raw("COUNT(DISTINCT user_id) as total_user_online")
            )
            ->whereNotNull('user_id')
            ->where('last_activity', '>=', Carbon::now()->subDays(6)->timestamp)
            ->groupBy('date_aktif')
            ->orderBy('date_aktif', 'ASC')
            ->get();

        // Olah data agar dayName -> total
        // (Monday, Tuesday, dll.) atau format 'd M'
        // Tergantung selera
        $onlineChart = collect();
        foreach ($activeSessions as $row) {
            $tanggal = Carbon::parse($row->date_aktif);
            $dayName = $tanggal->format('l'); 
            // atau ->format('d M')
            $onlineChart->push([
                'day'   => $dayName,
                'count' => $row->total_user_online,
            ]);
        }

        // Urutkan Monday->Sunday (opsional)
        $orderMap = [
            'Monday'    => 1,
            'Tuesday'   => 2,
            'Wednesday' => 3,
            'Thursday'  => 4,
            'Friday'    => 5,
            'Saturday'  => 6,
            'Sunday'    => 7,
        ];
        $onlineChart = $onlineChart->sortBy(function($item) use ($orderMap) {
            return $orderMap[$item['day']] ?? 999;
        })->values();

        // Bentuk data Apex
        $onlineUsersChartData = [
            'days'   => $onlineChart->pluck('day'),  
            'counts' => $onlineChart->pluck('count'),
        ];

        return view('admin.dashboard.index', [
            'chartData'                     => $chartData,
            'registeredUsersCount'          => $registeredUsersCount,
            'salesChartData'                => $salesChartData,
            'topEventChart'                 => $topEventChart,
            'topEventsWithTicketTypesChart' => $topEventsWithTicketTypesChart,
            'onlineUsersChartData' => $onlineUsersChartData,
        ]);
    }
}