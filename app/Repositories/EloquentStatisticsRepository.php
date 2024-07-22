<?php

namespace App\Repositories;

use App\Models\BookViewLog;
use App\Models\UserBook;
use Carbon\Carbon;

class EloquentStatisticsRepository
{
    public function getMostReceivedBook()
    {
        $books = UserBook::select('book_id')
            ->selectRaw('count(*) as total_received')
            ->groupBy('book_id')
            ->orderBy('total_received', 'desc')
            ->limit(10)
            ->with('book')
            ->get()
            ->map(function ($item) {
                return [
                    'book' => $item->book,
                    'total_received' => $item->total_received,
                ];
            });

        return $books;
    }

    public function getMostTakeBookUser()
    {

        $users = UserBook::select('user_id')
            ->selectRaw('count(*) as total_books')
            ->groupBy('user_id')
            ->orderBy('total_books', 'desc')
            ->limit(10)
            ->with('user', 'book')
            ->get();

        if ($users->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'No users found.',
                'data' => [],
            ]);
        }

        $mappedUsers = $users->map(function ($item) {
            return [
                'user' => $item->user,
                'books' => $item->book,
                'total_books' => $item->total_books,
            ];
        });

        return response()->json([
            'status' => 200,
            'data' => $mappedUsers,
        ]);
    }

    public function getDailyStatistics()
    {
        $today = Carbon::today();
        $books = UserBook::whereDate('dateoftake', $today)
            ->with('book')
            ->get();

        if ($books->isEmpty()) {
            return response()->json([
                'message' => 'No books were taken today.',
                'status' => 200,
            ]);
        }

        return response()->json([
            'data' => $books->map(function ($item) {
                return [
                    'book' => $item->book,
                    'user_id' => $item->user_id,
                    'dateoftake' => $item->dateoftake,
                ];
            }),
            'status' => 200,
        ]);

    }

    public function getWeeklyStatistics()
    {
        $today = Carbon::today();

        $startOfWeek = Carbon::now('UTC')->startOfWeek();
        $endOfWeek = Carbon::now('UTC')->endOfWeek();
        $books = UserBook::whereBetween('dateoftake', [$startOfWeek, $endOfWeek])
            ->with('book')
            ->get();

        if ($books->isEmpty()) {
            return response()->json([
                'message' => 'No books were taken this week.',
                'status' => 200,
            ]);
        }

        return response()->json([
            'data' => $books->map(function ($item) {
                return [
                    'book' => $item->book,
                    'user_id' => $item->user_id,
                    'dateoftake' => $item->dateoftake,
                ];
            }),
            'status' => 200,
        ]);
    }

    public function getMonthlyStatistics()
    {
        $startOfMonth = Carbon::now('UTC')->startOfMonth();
        $endOfMonth = Carbon::now('UTC')->endOfMonth();

        $books = UserBook::whereBetween('dateoftake', [$startOfMonth, $endOfMonth])
            ->with('book')
            ->get();

        if ($books->isEmpty()) {
            return response()->json([
                'message' => 'No books were taken this month.',
                'status' => 200,
            ]);
        }

        return response()->json([
            'data' => $books->map(function ($item) {
                return [
                    'book' => $item->book,
                    'user_id' => $item->user_id,
                    'dateoftake' => $item->dateoftake,
                ];
            }),
            'status' => 200,
        ]);
    }

    public function getMostViewedBook()
    {
        $books = BookViewLog::select('book_id', \DB::raw('count(*) as view_count'))
            ->groupBy('book_id')
            ->orderBy('view_count', 'desc')
            ->limit(10)
            ->get();

        $bookDetails = $books->map(function ($log) {
            return [
                'book' => \App\Models\Book::find($log->book_id),
                'view_count' => $log->view_count,
            ];
        });

        return response()->json([
            'data' => $bookDetails,
            'status' => 200,
        ]);
    }
}
