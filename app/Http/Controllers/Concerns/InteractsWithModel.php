<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\Request;

trait InteractsWithModel
{
    abstract protected function query();
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
        $query = $this->query();
        $model = $this->getModel();
        $model = new $model;

        $inputs = $request->all();

        if(in_array('App\Concerns\Searchable', class_uses($model)))
        {
            $fields = $model->getTables($inputs);
            // $fields is now a list of expected values mapped to the tables
        } else {
            $fields = array_intersect_key(array_flip($model->getFillable()), $inputs);
            $fields = array_combine($fields, array_flip($fields));
            // $fields is now all of the values that are in fillable that was
            // sent with request. Then on top of that it's mapped to itself
        }

        foreach($fields as $input => $column)
        {
            $query->where($column, 'like', '%' . $inputs[$input] . '%');
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
