<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Library\Vk;
class GetVkWall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wall:post {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all posts from Wall';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user_id = $this->argument('user');

        $userModelPath = config('admin.database.users_model');
        $userModel = new $userModelPath();
        $user = $userModel::select(['id', 'name', 'avatar'])->where(['id'=>$user_id])->first();

        $vkModel = new Vk($user);
        $vkModel->getWall();
    }
}
