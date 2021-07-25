<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class InboxController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'admin']);
    }

    public function index(){
        $contactsIsNotRead = Contact::where('is_read', false)->orderby('created_at', 'desc')->paginate(15);
        $contacts = Contact::orderby('created_at', 'desc')->paginate(20);

        return view('admin.inboxs', [
            'contactsIsNotRead' => $contactsIsNotRead,
            'contacts' => $contacts
        ]);
    }

    public function show($id) {
        $contact = Contact::findOrFail($id);
        $contact->update([
            'is_read' => true
        ]);

        return view('admin.inbox', ['contact' => $contact]);
    }

    public function search(Request $request) {}
}
