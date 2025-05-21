<?php

namespace App\Http\Controllers\Owner;

use App\Models\Kamar;
use App\Models\Pemeliharaan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class MaintenanceScheduleController extends Controller
{
    public function index() 
    {
        $times = [
            "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", 
            "15:00", "16:00", "17:00", "18:00", "19:00", "20:00",
        ];
        
        $days = [
            "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu",
        ];

        // Get all pemeliharaan records
        $pemeliharaans = Pemeliharaan::with('kamar')->get();
        
        // Create a schedule matrix for display
        $schedules = [];
        
        // Loop through pemeliharaan records to organize by day and time
        foreach($pemeliharaans as $pemeliharaan) {
            // Use jadwal field if available, otherwise use created_at
            $date = $pemeliharaan->jadwal ? Carbon::parse($pemeliharaan->jadwal) : Carbon::parse($pemeliharaan->created_at);
            $day = $this->getDayName($date->dayOfWeek);
            $time = $date->format('H:00');
            
            // Check if time is within our display schedule
            if (in_array($time, $times)) {
                if (!isset($schedules[$day])) {
                    $schedules[$day] = [];
                }
                
                if (!isset($schedules[$day][$time])) {
                    $schedules[$day][$time] = [];
                }
                
                $schedules[$day][$time][] = $pemeliharaan;
            }
        }

        return view('owner.maintenanceSchedule.index', [
            'title' => 'Jadwal Pemeliharaan',
            'pemeliharaans' => $pemeliharaans,
            'days' => $days,
            'times' => $times,
            'schedules' => $schedules,
        ]);
    }
    
    /**
     * Convert numeric day of week to Indonesian day name
     */
    private function getDayName($dayNumber)
    {
        $days = [
            1 => "Senin",
            2 => "Selasa",
            3 => "Rabu",
            4 => "Kamis",
            5 => "Jumat",
            6 => "Sabtu",
            0 => "Minggu",
        ];
        
        return $days[$dayNumber];
    }
    
    /**
     * Show the form for creating a new pemeliharaan.
     */
    public function create()
    {
        $kamars = Kamar::all();
        $days = [
            "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu",
        ];
        
        $times = [
            "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", 
            "15:00", "16:00", "17:00", "18:00", "19:00", "20:00",
        ];
        
        return view('owner.maintenanceSchedule.create', [
            'title' => 'Tambah Jadwal Pemeliharaan',
            'kamars' => $kamars,
            'days' => $days,
            'times' => $times,
        ]);
    }
    
    /**
     * Store a newly created pemeliharaan in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam' => 'required|date_format:H:i',
            'status' => 'required|in:sedang-proses,selesai',
            'keterangan' => 'required|string',
        ]);
        
        // Get current date as base
        $currentDate = now();
        
        // Calculate the date for the selected day of week
        $targetDayNumber = $this->getDayNumber($validated['hari']);
        $currentDayNumber = $currentDate->dayOfWeek;
        
        // Calculate days to add to reach target day (0 = Sunday in Carbon, but we use 0 for Monday)
        $daysToAdd = ($targetDayNumber - $currentDayNumber + 7) % 7;
        if ($daysToAdd === 0 && $targetDayNumber !== $currentDayNumber) {
            $daysToAdd = 7;
        }
        
        $scheduledDate = $currentDate->copy()->addDays($daysToAdd);
        
        // Combine date and time
        $scheduledDateTime = $scheduledDate->format('Y-m-d') . ' ' . $validated['jam'] . ':00';
        
        // Create new pemeliharaan with scheduled datetime
        $pemeliharaan = new Pemeliharaan();
        $pemeliharaan->kamar_id = $validated['kamar_id'];
        $pemeliharaan->status = $validated['status'];
        $pemeliharaan->keterangan = $validated['keterangan'];
        $pemeliharaan->jadwal = $scheduledDateTime; // Add this field to migration
        $pemeliharaan->save();
        
        return redirect()->route('jadwalPemeliharaan.index')
            ->with('success', 'Jadwal pemeliharaan berhasil ditambahkan');
    }
    
    /**
     * Convert day name to numeric value
     */
    private function getDayNumber($dayName)
    {
        $days = [
            'Senin' => 1,
            'Selasa' => 2,
            'Rabu' => 3,
            'Kamis' => 4,
            'Jumat' => 5,
            'Sabtu' => 6,
            'Minggu' => 0,
        ];
        
        return $days[$dayName] ?? 1; // Default to Monday
    }
    
    /**
     * Display the specified pemeliharaan.
     */
    public function show(Pemeliharaan $pemeliharaan)
    {
        return view('owner.maintenanceSchedule.show', [
            'title' => 'Detail Pemeliharaan',
            'pemeliharaan' => $pemeliharaan->load('kamar'),
        ]);
    }
    
    /**
     * Show the form for editing the specified pemeliharaan.
     */
    public function edit(Pemeliharaan $pemeliharaan)
    {
        $kamars = Kamar::all();
        $days = [
            "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu",
        ];
        
        $times = [
            "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", 
            "15:00", "16:00", "17:00", "18:00", "19:00", "20:00",
        ];
        
        // Get current scheduled day and time
        $scheduledDay = "Senin"; // Default to Monday
        $scheduledTime = "08:00"; // Default to 8 AM
        
        if ($pemeliharaan->jadwal) {
            $scheduledDate = Carbon::parse($pemeliharaan->jadwal);
            $scheduledDay = $this->getDayName($scheduledDate->dayOfWeek);
            $scheduledTime = $scheduledDate->format('H:i');
        }
        
        return view('owner.maintenanceSchedule.edit', [
            'title' => 'Edit Jadwal Pemeliharaan',
            'pemeliharaan' => $pemeliharaan,
            'kamars' => $kamars,
            'days' => $days,
            'times' => $times,
            'scheduledDay' => $scheduledDay,
            'scheduledTime' => $scheduledTime,
        ]);
    }
    
    /**
     * Update the specified pemeliharaan in storage.
     */
    public function update(Request $request, Pemeliharaan $pemeliharaan)
    {
        // Validate the request
        $validated = $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam' => 'required|date_format:H:i',
            'status' => 'required|in:sedang-proses,selesai',
            'keterangan' => 'required|string',
        ]);
        
        // Get current scheduled date or use now as base
        $currentSchedule = $pemeliharaan->jadwal ? Carbon::parse($pemeliharaan->jadwal) : now();
        
        // Calculate the date for the selected day of week
        $targetDayNumber = $this->getDayNumber($validated['hari']);
        
        // Get the date of the next occurrence of the target day
        $currentDate = now();
        $currentDayNumber = $currentDate->dayOfWeek;
        
        // Calculate days to add to reach target day
        $daysToAdd = ($targetDayNumber - $currentDayNumber + 7) % 7;
        if ($daysToAdd === 0 && $targetDayNumber !== $currentDayNumber) {
            $daysToAdd = 7;
        }
        
        $scheduledDate = $currentDate->copy()->addDays($daysToAdd);
        
        // Combine date and time
        $scheduledDateTime = $scheduledDate->format('Y-m-d') . ' ' . $validated['jam'] . ':00';
        
        // Update the pemeliharaan
        $pemeliharaan->kamar_id = $validated['kamar_id'];
        $pemeliharaan->status = $validated['status'];
        $pemeliharaan->keterangan = $validated['keterangan'];
        $pemeliharaan->jadwal = $scheduledDateTime;
        $pemeliharaan->save();
        
        return redirect()->route('jadwalPemeliharaan.show', $pemeliharaan->id)
            ->with('success', 'Jadwal pemeliharaan berhasil diperbarui');
    }
    
    /**
     * Confirm before destroying the specified pemeliharaan.
     */
    public function delete(Pemeliharaan $pemeliharaan)
    {
        return view('owner.maintenanceSchedule.delete', [
            'title' => 'Hapus Jadwal Pemeliharaan',
            'pemeliharaan' => $pemeliharaan->load('kamar'),
        ]);
    }
    
    /**
     * Remove the specified pemeliharaan from storage.
     */
    public function destroy(Pemeliharaan $pemeliharaan)
    {
        $pemeliharaan->delete();
        
        return redirect()->route('jadwalPemeliharaan.index')
            ->with('success', 'Jadwal pemeliharaan berhasil dihapus');
    }
}