<?php

namespace App\Http\Controllers;

use App\Repositories\EloquentStatisticsRepository;

class StatisticsController extends Controller
{
    protected $repo;

    public function __construct(EloquentStatisticsRepository $eloquentStatisticsRepository)
    {
        $this->repo = $eloquentStatisticsRepository;
    }

    public function getMostReceivedBook()
    {
        $books = $this->repo->getMostReceivedBook();

        return $books;
    }

    public function getMostTakeBookUser()
    {
        $users = $this->repo->getMostTakeBookUser();

        return response()->json($users);
    }

    public function getDailyStatistics()
    {
        $statistics = $this->repo->getDailyStatistics();

        return $statistics;
    }

    public function getWeeklyStatistics()
    {
        $statistics = $this->repo->getWeeklyStatistics();

        return $statistics;
    }

    public function getMonthlyStatistics()
    {
        $statistics = $this->repo->getMonthlyStatistics();

        return $statistics;
    }

    public function getMostViewedBook()
    {
        $books = $this->repo->getMostViewedBook();

        return response()->json($books);
    }
}
