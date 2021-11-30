<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 * @package App\Repositories
 */
abstract class BaseRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param int $perPage
     * @return mixed
     */
    public function paginate(int $perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * @param array $arrParams
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $arrParams)
    {
        $model = $this->model->newInstance();

        $model->fill($arrParams);
        $model->save();

        return $model;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        return $this->find($id)->delete();
    }

    /**
     * @param string|int $id
     * @return Model|null
     * @throws \Exception
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @param Model $model
     * @param array $arrParams
     * @return Model
     */
    public function update(Model $model, array $arrParams)
    {
        $model->fill($arrParams);
        $model->save();

        return ($model);
    }
}
