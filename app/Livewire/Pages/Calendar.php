<?php

namespace App\Livewire\Pages;

use App\Models\Task;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Calendar extends Component
{
    public $currentMonth;
    public $currentYear;

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

    public function selectDate($date)
    {
        $this->dispatch('redirect-to-date', date: $date);
    }

    public function render()
    {
        $startOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $startDayOfWeek = $startOfMonth->dayOfWeek;
        $startDate = $startOfMonth->copy()->subDays($startDayOfWeek);

        $days = [];
        for ($i = 0; $i < 35; $i++) {
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
