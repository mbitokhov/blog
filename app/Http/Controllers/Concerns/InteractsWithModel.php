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
        $model = $this->query();

        $inputs = $request->all();

        if(in_array('\App\Concerns\Searchable', class_uses($model)))
        {
            $fields = $model::searchable($inputs);
        } else {
            $fields = array_intersect_key($inputs, array_flip($model->getFillable()));
        }

        foreach($fields as $column => $input)
        {
            $model->where($column, 'like', '%'.$input.'%');
        }

        $model = $model->simplePaginate();
        $model->appends($request->query->all());

        return $model;
    }
    protected function getModel()
    {
        $controller = class_basename($this);
        $model      = substr($controller, 0, -1 * strlen('controller'));
        $model      = 'App\\'.$model;

        return $model;
    }
}
