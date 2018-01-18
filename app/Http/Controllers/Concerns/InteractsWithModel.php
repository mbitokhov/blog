<?php

use Illuminate\Database\Eloquent\Model;

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

    public function updateModel(Model $model, $id)
    {
        return $this->createModel($model, $id);
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

    public function index(Request $request, $id)
    {
        $model = $this->getModel();

        $inputs = $request->all();
        foreach($inputs as $column => $input)
        {
            if(! $model->isFillable($input))
            {
                continue;
            }

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
        $model      = 'App/'.$model;

        return $model;
    }
}
