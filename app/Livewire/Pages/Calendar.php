<?php

namespace App\Livewire\Pages;

use App\Models\Task;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Calendar extends Component
{
    public $currentMonth;

    public $currentYear;

    public $selectedDate = null;

    public function selectDate($date)
    {
        $this->selectedDate = $date;
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
        $daysInMonth = $startOfMonth->daysInMonth;
        $startDay = $startOfMonth->startOfWeek(Carbon::SUNDAY);
        $endDay = $startOfMonth->copy()->endOfMonth()->endOfWeek(Carbon::SATURDAY);

        $days = [];
        $current = $startDay->copy();

        while ($current->lte($endDay)) {
            $tasks = Task::where('user_id', auth()->id())
                ->whereDate('due_date', $current->toDateString())
                ->get();

            $days[] = [
                'date' => $current->copy(),
                'isCurrentMonth' => $current->month == $startOfMonth->month,
                'tasks' => $tasks,
            ];

            $current->addDay();
        }

        return view('livewire.pages.calendar', [
            'days' => $days,
            'monthName' => $startOfMonth->format('F'),
            'year' => $this->currentYear,
        ]);
    }
}
