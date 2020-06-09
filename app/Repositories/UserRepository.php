<?php

namespace App\Repositories;

use App\User;
use Exception;
use App\Comment;
use App\Contracts\UserInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository implements UserInterface
{
    /**
    * User with comments
    * @param $userId | User's Id
    */
    public function index($userId) {
        try {
            $user = User::find($userId);
            if ($user) {
                $file = public_path('images/users/' . $user->id . '.jpg');
                if ( File::exists($file) ) $user->image = asset('images/users/' . $user->id . '.jpg');
                else $user->image = asset('images/users/default-avatar.jpg');
                return view('pages.view', compact('user'));
            } else abort(404);
        } catch (NotFoundHttpException $e) {
            Log::error('Not Found Exception');
            abort(404);
        } catch (Exception $e) {
            Log::error('Server Error');
            abort(500);
        }
    }

    /**
    * @param $userId | User's Id
    */
    public function getUser($userId)
    {
        return User::findOrFail($userId);
    }

    /**
    * Save user's comment
    * @param $data | Array { User's Id, comment }
    * @return Comment Obj
    */
    public function saveComment($data)
    {
        $comment = new Comment();
        $comment->user_id = $data['id'];
        $comment->comment = $data['comment'];
        $comment->save();
        return $comment;
    }
}