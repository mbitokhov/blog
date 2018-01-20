<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\Request;

trait InteractsWithModel
{
    /**
     *
     *
     */
    public function createModel(Request $request, $id=null)
    {
        $model = $this->getModel();
        $model = $model::findOrNew($id);

        $model->fill($request->all());
        $model->save();

        return $model;
    }

    public function updateModel(Request $request, $id)
    {
        return $this->createModel($request, $id);
    }

    public function findModel($id)
    {
        $model = $this->getModel();
        $model = $model::findOrFail($id);

        return $model;
    }

    public function deleteModel(Request $request, $id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $model;
    }

    public function index(Request $request)
    {
        $model = $this->getModel();
        $model = new $model;

        if($model->hasSearchableTrait()) {
            $inputs = $request->all();
            $fields = $model->getTables($inputs);
            // $fields is now a list of expected values mapped to the tables

            $query = $model->searchQuery();
            foreach($fields as $input => $column)
            {
                $query->where($column, 'like', '%' . $inputs[$input] . '%');
            }
        } else {
            $query = $model;
        }

        $query = $query->simplePaginate();
        $query->appends($request->query->all());

        return $query;
    }

    protected function getModel()
    {
        $controller = class_basename($this);
        $model      = substr($controller, 0, -1 * strlen('controller'));
        $model      = 'App\\'.$model;

        return $model;
    }
}
