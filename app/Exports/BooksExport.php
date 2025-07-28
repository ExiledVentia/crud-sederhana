<?php

namespace App\Exports;

use App\Models\Book;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class BooksExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $query = Book::query()->with('category', 'publisher');

        if ($this->request->filled('search')) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->request->search . '%')
                    ->orWhere('author', 'like', '%' . $this->request->search . '%')
                    ->orWhere('description', 'like', '%' . $this->request->search . '%');
            });
        }

        if ($this->request->filled('category_id')) {
            $query->where('category_id', $this->request->category_id);
        }

        if ($this->request->filled('publisher_id')) {
            $query->where('publisher_id', $this->request->publisher_id);
        }

        if ($this->request->filled('start_date') && $this->request->filled('end_date')) {
            $startDate = Carbon::parse($this->request->start_date)->startOfDay();
            $endDate = Carbon::parse($this->request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        
        return $query->latest();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Author',
            'Publisher',
            'Category',
            'Created At',
        ];
    }

    public function map($book): array
    {
        return [
            $book->id,
            $book->title,
            $book->author,
            $book->publisher->publisher_name,
            $book->category->category_name,
            Carbon::parse($book->created_at)->toDateTimeString(),
        ];
    }
}