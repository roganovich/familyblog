<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\Category;

/**
 * Class BlogCategoryRepository
 * @package App\Repositories
 */
class BlogCategoryRepository extends CoreRepository  {

    /**
     * @return string
     */
    protected function getModelClass() {

        return Category::class;
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
        $columns = implode(',',['id','title','CONCAT (id, ". " , title ) as id_title']);
        $result = $this->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();
        return $result;

    }

    public function getAllWithPaginator($perPage = null){
        $columns = ['id','title','slug'];

        $result = $this->startConditions()
            ->select($columns)
            ->paginate($perPage);

        return $result;
    }
}