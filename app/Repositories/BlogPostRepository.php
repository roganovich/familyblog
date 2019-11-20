<?php
namespace App\Repositories;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BlogCategoryRepository
 * @package App\Repositories
 */
class BlogPostRepository extends CoreRepository  {

    /**
     * @return string
     */
    protected function getModelClass() {

        return Post::class;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getForeEdit($id){
        return $this->startConditions()->find($id);
    }

    /**
     * @return mixed
     */
    public function getCategoriesList(){
        $model = app(BlogCategoryRepository::class);
        return $model->getCategoriesList();

    }

    public function getAllWithPaginator($perPage = null){
        $columns = [
            'id',
            'title',
            'intro_html',
            'slug',
            'author_id',
            'is_published',
            'published_at',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id','DESC')
            ->with('author', 'categories')
            ->paginate($perPage);

        return $result;
    }
}