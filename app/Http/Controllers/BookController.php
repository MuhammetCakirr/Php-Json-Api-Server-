<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\BookViewLog;
use App\Repositories\BookRepositoryInterface;
use App\Services\BookService;

class BookController extends Controller
{
    protected $service;

    protected $repository;

    public function __construct(BookRepositoryInterface $bookRepositoryInterface, BookService $bookService)
    {
        $this->service = $bookService;
        $this->repository = $bookRepositoryInterface;
    }

    public function index()
    {
        $books = $this->repository->getAllBook();

        return response()->json($books);
    }

    public function show($id)
    {
        $userId = auth()->check() ? auth()->id() : null;
        $ipAddress = request()->ip();
        // BookViewLog::create([
        //     'user_id' => $userId,
        //     'book_id' => $id,
        //     'ip_address' => $ipAddress,
        //     'viewed_at' => now(),
        // ]);

        $book = $this->repository->findById($id, $userId, $ipAddress);

        return response()->json($book);
    }

    public function create(BookRequest $request)
    {
        $book = $this->service->create($request->validated());
        if ($book == '400') {
            $data = [
                'status' => 400,
                'message' => 'There is already a book with such a name.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Book was successfully created.',
                'data' => $book,
            ];
        }

        return response()->json($data);
    }

    public function update($id, BookUpdateRequest $bookUpdateRequest)
    {
        $book = $this->service->update($id, $bookUpdateRequest->validated());
        if ($book == null || empty($book) || $book == '404') {
            $data = [
                'status' => 400,
                'message' => 'There is no book belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Book has been successfully updated.',
                'data' => $book,
            ];
        }

        return response()->json($data);
    }

    public function delete($id)
    {
        $result = $this->service->delete($id);

        if ($result === null || $result === '400') {
            $data = [
                'status' => 400,
                'message' => 'There is no book belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Book was successfully deleted.',
            ];
        }

        return response()->json($data);
    }
}
