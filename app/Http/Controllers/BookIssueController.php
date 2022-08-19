<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BookIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookIssue as MailBookIssue;
use App\Mail\BookReturn;

class BookIssueController extends Controller
{
    // Request Book to Issue
    public function request_book($book_id)
    {
        $user_id = Auth::id();

        // Check if book was not issue to user before
        $books_issued = DB::select('select * from book_issues where user_id = ?', [$user_id]);
        foreach ($books_issued as $key => $book) {
            if ($book->book_id == $book_id && $book->issue == '') {
                return redirect()->back()->with('error', 'you have already requested this book before!');
            }
        }

        $issue = new BookIssue();
        $issue->book_id = $book_id;
        $issue->user_id = $user_id;
        $issue->save();

        return redirect()->back()->with('message', 'Your request for issue book has been received');
    }


    // Get All Books To Issue
    public function issue_requests()
    {
        $books = DB::table('book_issues')
            ->join('users', 'users.id', '=', 'book_issues.user_id')
            ->join('books', 'books.id', '=', 'book_issues.book_id')
            ->where('issue', '=', null)
            ->select('book_issues.id as issue_id', 'book_issues.issue as issue', 'books.*', 'users.name')->get();

        return view('books.issue_request', ['books' => $books]);
    }

    // Approve Issue Request
    public function issue_book($issue_id)
    {
        $request_book = BookIssue::find($issue_id);
        $request_book->issue = true;
        $request_book->save();

        // Send Email to User When approved Issue Request
        $user = User::find($request_book->user_id);
        Mail::to($user->email)->send(new MailBookIssue);

        return redirect()->route('book_issues.issue_requests')->with('message', 'Approved Book Successfully');
    }

    // Return Back Issued Book
    public function return_book($issue_id)
    {
        $book_issued = BookIssue::find($issue_id);
        $book_issued->issue = false;
        $book_issued->save();

        // Send Email to User When Book Returned Successfully
        $user = Auth::user();
        Mail::to($user->email)->send(new BookReturn);

        return redirect()->back()->with('message', 'You have successfully returned book');
    }
}
