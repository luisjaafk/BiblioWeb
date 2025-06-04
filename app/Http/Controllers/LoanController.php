<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Notifications\LoanNotification;
use Barryvdh\DomPDF\Facade\Pdf;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('user', 'book')->paginate(10);
        return view('loans.index', compact('loans'));
    }

    public function exportPdf()
    {
        $loans = Loan::with(['book', 'user'])
                    ->whereNull('returned_at')
                    ->get();

        $pdf = Pdf::loadView('pdf.loans', compact('loans'));
        return $pdf->download('libros_pedidos.pdf');
    }

    public function create()
    {
        $users = User::all();
        $books = Book::where('status', 'disponible')->get();

        return view('loans.create', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'return_date' => 'nullable|date|after:today',
        ]);

        // Verificar si el libro ya está prestado
        $existingLoan = Loan::where('book_id', $validated['book_id'])
            ->whereNull('returned_at')
            ->first();

        if ($existingLoan) {
            return back()->withErrors(['book_id' => 'El libro ya está prestado.'])->withInput();
        }

        $returnDate = $validated['return_date'] ?? now()->addDays(15);

        // Crear préstamo
        $loan = Loan::create([
            'user_id' => $validated['user_id'],
            'book_id' => $validated['book_id'],
            'loan_date' => now(),
            'return_date' => $returnDate,
        ]);

        // Actualizar estado del libro
        $book = Book::find($validated['book_id']);
        $book->status = 'prestado';
        $book->save();

        // Enviar notificación al usuario
        $user = User::find($validated['user_id']);
        $user->notify(new LoanNotification($loan));

        return redirect()->route('loans.index')->with('success', 'Préstamo registrado correctamente.');
    }

    public function returnBook(Loan $loan)
    {
        if ($loan->returned_at) {
            return back()->with('error', 'El libro ya fue devuelto anteriormente.');
        }

        DB::transaction(function () use ($loan) {
            $loan->returned_at = now();
            $loan->save();

            $book = $loan->book;
            $book->status = 'disponible';
            $book->save();
        });

        return back()->with('success', 'Libro devuelto correctamente.');
    }

}
