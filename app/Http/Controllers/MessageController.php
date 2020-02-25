<?php

namespace App\Http\Controllers;

use App\Mail\firstMail;
use App\Message;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class MessageController extends Controller
{
    public function index(){
        $messages = Message::where('sent_to', Auth::id())->get();
        return view('messages.index', compact('messages'));
    }

    public function sent(){
        $messages = Message::where('author', Auth::id())->get();
        return view('messages.index', compact('messages'));
    }


    public function new(){
        return view('messages.create');
    }

    public function reply($id){
        $oldMessage = Message::findOrFail($id);
        if($oldMessage->sent_to == Auth::id()) {
            $author = $oldMessage->user->name;
            $subject = 'Re: ' . $oldMessage->subject;
            $fromDate = $oldMessage->created_at->format('d.m.Y');
            $content = "\n\n\n\n\n\n\n\n ------------ \n" . "On $fromDate $author wrote: \n\n" . $oldMessage->content;
            return view('messages.create', compact('author', 'subject', 'content'));
        }else{
            return redirect()->back();
        }
//        $oldMessage = Message::where('id', $id)->where('sent_to', Auth::id())->get();
//            $author = User::findOrFail($oldMessage[0]['author'])->name;
//            $subject = 'Re: ' . $oldMessage[0]['subject'];
//            $fromDate = $oldMessage[0]['created_at']->format('d.m.Y');
//            $content = "\n\n\n\n\n\n\n\n ------------ \n" . "On $fromDate $author wrote: \n\n" . $oldMessage[0]['content'];
////
//            return view('messages.create', compact('author', 'subject', 'content'));

    }

    public function send(Request $request){

        $this->validate($request,[
            'sent_to'=>'required|max:150',
            'subject'=>'required|max:250',
            'content'=>'required|max:10000',
            'viewed'=>'nullable|numeric',
            'starred'=>'nullable|numeric',
        ]);

        global $message;
        $message = $request->all();

        //Check if address is email or name
        function checkEmail($email){
            $find1 = strpos($email, '@');
            $find2 = strpos($email, ".");
            return ($find1 !==false && $find2 !==false && $find2 > $find1 ? true : false);
        }
        if(checkEmail($message['sent_to'])){
//            $content = $message['content'];
//            $email = $message['sent_to'];
//            Mail::to($message['sent_to'])->send(new firstMail($request));
            $con = @fsockopen('smtp.mailtrap.io', 2525);
            if($con) {
                //this is the way that works without using Mail class "firstMail"
                $data = ['content' => $message['content']];
                Mail::send('emails.first', $data, function ($mes) {
                    global $message; //TODO: Not good way to use global variable!
                    $mes->to($message['sent_to'])->subject($message['subject']);
                });
                fclose($con);
            }else{
                Session::flash('msg', "No internet. Please try later.");
                return redirect()->back();
            }
            $message['sent_to'] = 0; //no user when using unknown email
//            Session::flash('msg_sent', "Recipient is email");
//            return redirect('/inbox');
        }else{
            if(User::where('name', '=', $request->sent_to)->exists()){
            $sent_to_user = User::where('name', $request->sent_to)->get();
                $message['sent_to'] = $sent_to_user[0]['id']; //TODO: find better way to extract the user id
            }else{
                return redirect()->back()->withErrors(["There is no user with the name $request->sent_to"]);
            }
        }
        $message['author'] = Auth::id();
        Message::create($message);
        Session::flash('msg', "Message has been sent");
        return redirect('/inbox');

    }

    public function show($id){
        $message = Message::findOrFail($id);
        if($message->sent_to == Auth::id() or $message->author == Auth::id()) {
            if($message->sent_to == Auth::id()) {
                $message->update(['viewed' => 1]);
            }
            return view('messages.show', compact('message'));
        }else{
            return response()->view('errors.404', [], 404);
        }
    }

    public function destroy($id){
        $message = Message::findOrFail($id);
        if($message->sent_to == Auth::id() or $message->author == Auth::id()){
            $message->delete();
            Session::flash('msg', 'Message has been deleted!');
        }
        return redirect()->back();
    }

}
