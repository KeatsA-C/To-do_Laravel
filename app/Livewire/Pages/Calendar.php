<?php

namespace App\Livewire\Pages;

use App\Models\Task;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Calendar extends Component
{
    public $currentMonth;

    public $currentYear;

    public function selectDate($date)
    {
        return Redirect::route('dashboard', ['date' => $date]);
    }

    public function mount()
    {
        $now = now();
        $this->currentMonth = $now->month;
        $this->currentYear = $now->year;
    }

    public function previousMonth()
    {
        $this->adjustMonth(-1);
    }

    public function nextMonth()
    {
        $this->adjustMonth(1);
    }

    private function adjustMonth($offset)
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonths($offset);
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
    }

    public function render()
    {
        $startOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $startDayOfWeek = $startOfMonth->dayOfWeek; // 0 = Sunday

        // Get the Sunday before the first day of the month
        $startDate = $startOfMonth->copy()->subDays($startDayOfWeek);

        $days = [];

        for ($i = 0; $i < 35; $i++) { // Display a 5-week calendar grid
            $date = $startDate->copy()->addDays($i);

            $tasks = Task::where('user_id', auth()->id())
                ->whereDate('due_date', $date->toDateString())
                ->get();

            $days[] = [
                'date' => $date,
                'isCurrentMonth' => $date->month === $startOfMonth->month,
                'tasks' => $tasks,
            ];
        }

        return view('livewire.pages.calendar', [
            'days' => $days,
            'monthName' => $startOfMonth->format('F'),
            'year' => $this->currentYear,
        ]);
    }
}
