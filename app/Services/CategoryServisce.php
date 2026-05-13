<?php

namespace App\Services;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;


class CategoryServisce
{
    public  function  getCatrgory()
    {
        return Category::paginate(2);
    }

    public function CreateCategory(array  $data)
    {
        try {
            $Catrgory = Category::create($data);
            return $Catrgory;
        }catch (\Exception $exception){
            throw $exception;
        }
    }

    public function  UpdateCatrgory(Category $category,array $data)
    {
        $category->update($data);
        return $category;
    }

    public function  destroyCatrgory($id)
    {
        $category= Category::findOrFail($id);
        $category->delete();
    }

}

