<?php

namespace App\Http\Controllers;

use Arr;
use Redirect;
use Validator;
use Illuminate\Http\Request;
use App\Contracts\UserInterface;

class UserController extends Controller
{
    /** 
     * @var $user 
     */
    protected $user;

    /**
     * Create a new controller instance.
     * @param $user | UserInterface
     * @return void
     */
    public function __construct(UserInterface $user) 
    {
        $this->user = $user;
    }

    /**
    * User detail with all comments
    * @param $userId | User's Id
    * @return View
    */
    public function index($userId) 
    {
        return $this->user->index($userId);
    }

    /**
    * Open Comment Form
    * @param $request | Request obj
    * @param $userId | User's Id
    * @param $type | { form | json }
    * @return View
    */
    public function commentForm(Request $request, $userId)
    {
        $formType = $request->type ?? "form";  // Comment or Json Comment
        $user = $this->user->getUser($userId);
        return view('pages.comment', compact('user', 'formType'));
    }

    /**
    * Save Comment as HTML Form Request
    * @param $request | Request obj
    * @return redirect to view page
    */
    public function saveComment(Request $request)
    {
        /*
        * Validating the request
        * We can store and match bcrypt password. But, currently we used it as normal text
        */
        $validator = $this->requestValidate($request->all());
        if ( $validator->fails() ) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        // Save comment for user
        $this->user->saveComment( $request->only('comment', 'id') );
        
        return redirect()->route('home');
    }

    /**
    * Save Comment as JSON Request
    * @param $request | Request obj
    * @return Json Obj
    */
    public function saveJsonComment(Request $request)
    {
        /*
        * Check valid json format of payload
        */
        $data = $this->validate($request, [
            'json' => 'required|json'
        ], [
            'json.json' => "Invalid JSON format."
        ]);
        
        /*
        * Validating the request
        * We can store and match bcrypt password. But, currently we used it as normal text
        */
        $validator = $this->requestValidate( json_decode($request->json, true) );
        if ( $validator->fails() ) {
            return response()->json(['message' => "Error", 'errors' => $validator->getMessageBag()->toArray()], 422);
        }

        // Save comment for user
        $this->user->saveComment( json_decode($request->json, true) );

        // JSON response
        return response()->json([
            'message' => "Success"
        ], 200);
    }

    /**
    * Request validation | Slim Controller 
    * @param $request | Array
    * @return Validator Obj
    */
    protected function requestValidate($request)
    {
        return Validator::make(Arr::wrap($request), [
            'id' => 'required|numeric|exists:users,id',
            'comment' => 'required|max:160',
            'password' => 'required|in:720DF6C2482218518FA20FDC52D4DED7ECC043AB' // We used bcrypt password, but for demo we have used as a text string
        ], [
            'id.required' => "User Id is required.",
            'id.numeric' => "User Id must be numeric.",
            'id.exists' => "Invalid User Id.",
            'comment.required' => "Comment is required.",
            'comment.max' => "Comment allow only 160 char.",
            'password.required' => "Password is required.",
            'password.in' => "Password is incorrect."
        ]);
    }
}