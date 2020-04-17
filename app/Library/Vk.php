<?php
namespace App\Library;
use App\Models\Blog\Post;
use App\Models\Blog\PostsCategories;
use App\Models\Uploader;
use Encore\Admin\Auth\Database\Administrator;
use ATehnix\VkClient\Client;
use ATehnix\VkClient\Requests\Request;
use ATehnix\VkClient\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;


class Vk{

    const AUTHOR_ID=1;
    private $_user;

    public function __construct(Administrator $user)
    {
        $this->_user = $user;
    }

    public function getWall(){

        $api = new Client;
        $api->setDefaultToken(config('vk.access_token'));
        $request = new Request('wall.get', ['owner_id' => config('vk.owner_id'),'filter'=>'owner','offset'=>40,'count'=>100]);//,'count'=>2
        $response = $api->send($request);

        //создаем посты
        $i = 0;
        foreach ($response['response']['items'] as $post){
            $this->createPost($post);
            $i++;
            /*if($item = $this->createPost($post)){
                $this->createTags($post);
            }*/
        }
        echo $i.' постов на стене';
    }

    public function createPost($post){
        //текст поста
        $text = (array_key_exists('text',$post))?$post['text']:[];
        //дата публикации
        $date = (array_key_exists('date',$post))?$post['date']:[];
        //вложения
        $attachments = (array_key_exists('attachments',$post))?$post['attachments']:[];

        $files = [];
        if ($attachments) {
            $request = new \Illuminate\Http\Request();
            $size_key = false;
            foreach ($attachments as $file) {
                $sizer = [];
                if ($file['type'] == 'photo') {
                    foreach ($file['photo'] as $key => $value) {
                        if (strpos($key,'photo_') !== false) {
                            $sizer[] = str_replace('photo_','', $key);
                        }
                    }
                    if($sizer ){
                        $file_key = 'photo_'.max($sizer);
                        if(array_key_exists($file_key,$file['photo'])) {
                            $file_path = $file['photo'][$file_key];
                            $file_name = $file['photo']['access_key'].''.$file['photo']['date'];

                            $info = pathinfo($file_path);
                            $filename = $info['basename'];
                            $tempImage = sys_get_temp_dir().'\\'. $filename;
                            copy($file_path,$tempImage);

                            $uploaded_file = new UploadedFile($tempImage, $info['basename']);
                            $files[] = $uploaded_file;
                        }
                    }
                }
            }
        }
        if(!$files){
            return;
        }
        //разделяем текст на строки
        $split = explode("\n", $text);
        //первая строка - это название поста
        $title = (count($split)>1)?$split[0]:$text;
        $title = Str::limit($title,50);
        if(!$item = Post::select(['id'])->where(['vk_id'=>$post['id']])->first()){

            $data = [
                'author_id'=>self::AUTHOR_ID,
                'title' => $title,
                'slug' => Str::slug($title),
                'intro_html' => Str::limit($text,100),
                'content_html' => $text,
                'is_published' => 1,
                'published_at' => date('Y-m-d H:i:s', $date),
                'created_at' => date('Y-m-d H:i:s', $date),
                'updated_at' => date('Y-m-d H:i:s', $date),
                'vk_id' => $post['id'],
            ];

            //new model object
            $item = new Post();
            if($item->create($data)){
                if($itemNew = Post::select(['id','title','vk_id'])->where(['vk_id'=>$post['id']])->first()) {
                    $cat = new PostsCategories();
                    $cat->create(['category_id' => 1, 'post_id' => $itemNew['id']]);

                    if ($files) {
                        $imgModel = new Uploader();
                        $imgModel->object = $itemNew;
                        $imgModel->files = $files;
                        $imgModel->uploadload();
                    }
                    return $itemNew;
                }
            }
        }
    }

     public function createTags($post){
        //текст поста
        $text = $post['text'];
        //добавляем пробелы между хештегами
        $tagStr = str_replace('#',' #',$text);
        //находим хэштеги в посте
        preg_match_all('/#[^\s]*/i ', $tagStr, $tags);
        //создаем категории по хештегам
        foreach ($tags as $tag){
            $this->createTag($tag);
        }
    }



}