<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use App\Contracts\UserInterface;

class UserCommentCommand extends Command
{
    /** 
     * @var $user 
    */
    protected $user;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:comment {id} {comment}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add user\'s comment from command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get Id from first argument | int
        $id = $this->argument('id');

        // Get Comment from second argument | string
        $comment = $this->argument('comment');

        $user = User::find($id);
        if( !$user ) {
            $this->error('User not found');
            exit;
        }

        // Save comment for user
        try {
            $this->user->saveComment( $array = [ 'id' => $id, 'comment' => $comment ] );
        } catch(\Exception $e) {
            $this->error($e->getMessage());
            exit;
        }

        $this->info("Comment added!");

        // print user's all comments with user details { refresh the collections }
        $this->line($user->refresh()->comments->pluck('comment')->implode(', '));
        
        exit;
    }
}
