<?php

namespace SpeakFree\Domain;

use SpeakFree\Domain\RepositoryInterface;

use Closure;
use Exception;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
  /**
   * Model Class Name
   *
   * @var Class
   */
  protected $modelClassName;

  /**
   * @var Model
   */
  protected $model;

  /**
   * @var \Closure
   */
  protected $scopeQuery = null;

  public function __construct()
  {
    $this->makeModel();
  }

  /**
   * @return Model
   * @throws Exception
   */
  public function makeModel()
  {
    $model = new $this->modelClassName;
    $this->scopeQuery = null;

    if (!$model instanceof Model)
      throw new Exception("Class {$this->modelClassName} must be an instance of Illuminate\\Database\\Eloquent\\Model");

    return $this->model = $model;
  }

  /**
   * Save a new entity in repository
   *
   * @param array $attributes
   * @return mixed
   */
  public function create(array $attributes)
  {
    return call_user_func_array("{$this->modelClassName}::create", array($attributes));
  }

  public function all($columns = array('*'))
  {
    $this->applyScope();

    if ($this->model instanceof \Illuminate\Database\Eloquent\Builder) {
      $results = $this->model->get($columns);
    } else {
      $results = $this->model->all($columns);
    }

    $this->resetModel();

    return $results;
  }

  public function find($id, $columns = array('*'))
  {
    $this->applyScope();
    $model = $this->model->findOrFail($id, $columns);
    $this->resetModel();
    return $model;
  }

  public function delete($ids)
  {
    $this->applyScope();

    $model = $this->model->find($ids);

    $this->resetModel();
    $deleted = $model->delete();
    return $deleted;
  }

  public function forceDelete($ids)
  {
    $this->applyScope();

    $model = $this->model->find($ids);

    $this->resetModel();
    $deleted = $model->forceDelete();

    return $deleted;
  }

  public function destroy($ids)
  {
    return call_user_func_array("{$this->modelClassName}::destroy", array($ids));
  }

  public function first($columns = array('*'))
  {
    $this->applyScope();
    $model = $this->model->first($columns);
    $this->resetModel();
    return $model;
  }

  public function lists($column, $key = null)
  {
    $this->applyScope();
    $results = $this->model->lists($column, $key);
    $this->resetModel();
    return $results;
  }

  public function findWhere(array $where, $columns = array('*'))
  {
    $this->applyScope();

    foreach ($where as $field => $value) {
      if (is_array($value)) {
        list($field, $condition, $val) = $value;
        $this->model = $this->model->where($field, $condition, $val);
      } else {
        $this->model = $this->model->where($field, '=', $value);
      }
    }

    return $this->model->get($columns);
  }

  /**
   * Update a entity in repository by id
   *
   * @param array $attributes
   * @param $id
   * @return mixed
   */
  public function update(array $attributes, $id)
  {

    $this->applyScope();
    $model = $this->model->findOrFail($id);
    $model->fill($attributes);
    $model->save();

    $this->resetModel();

    return $model;
  }

  public function count()
  {
    $this->applyScope();

    $result = $this->model->count();

    $this->resetModel();

    return $result;
  }

  public function exists(array $where = [])
  {
    $this->applyScope();

    if ($where) {
      $this->applyConditions($where);
    }

    $result = $this->model->exists();

    $this->resetModel();
    $this->resetScope();

    return $result;
  }

  /**
   * Retrieve all data of repository, paginated
   * @param null $limit
   * @param array $columns
   * @return mixed
   */
  public function paginate($limit = null, $columns = array('*'))
  {
    $this->applyScope();

    $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;
    $result = $this->model->paginate($limit, $columns);

    $this->resetModel();

    return $result;
  }

  /**
   * Retrieve all data of repository, paginated
   * @param null $limit
   * @param array $columns
   * @return mixed
   */
  public function simplePaginate($limit = null, $columns = array('*'))
  {
    $this->applyScope();

    $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;
    $result = $this->model->simplePaginate($limit, $columns);

    $this->resetModel();

    return $result;
  }

  /**
   * Retrieve all data of repository, paginated
   * @param null $limit
   * @param array $columns
   * @return mixed
   */
  public function grid($limit = null, $columns = array('*'))
  {
    $this->applyScope();

    $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;

    $result = $this->model->grid()->paginate($limit, $columns);

    $this->resetModel();

    return $result;
  }

  /**
   * Query Scope
   *
   * @param \Closure $scope
   * @return $this
   */
  public function scopeQuery(\Closure $scope)
  {
    $this->scopeQuery = $scope;
    return $this;
  }

  /**
   * Load relations
   *
   * @param array|string $relations
   *
   * @return $this
   */
  public function with($relations)
  {
    $this->model = $this->model->with($relations);

    return $this;
  }

  /**
   * Load relation with closure
   *
   * @param string  $relation
   * @param closure $closure
   *
   * @return $this
   */
  public function whereHas($relation, $closure)
  {
    $this->model = $this->model->whereHas($relation, $closure);

    return $this;
  }

  /**
   * Set the "orderBy" value of the query.
   *
   * @param mixed  $column
   * @param string $direction
   *
   * @return $this
   */
  public function orderBy($column, $direction = 'asc')
  {
    $this->model = $this->model->orderBy($column, $direction);

    return $this;
  }

  /**
   * To SQL
   *
   * @return $this
   */
  public function toSql()
  {
    $this->applyScope();

    $query = $this->model->toSql();

    $this->resetModel();

    return $query;
  }

  /**
   * Apply scope in current Query
   *
   * @return $this
   */
  protected function applyScope()
  {
    if (isset($this->scopeQuery) && is_callable($this->scopeQuery)) {
      $callback = $this->scopeQuery;
      $this->model = $callback($this->model);
    }
    return  $this;
  }

  /**
   * Applies the given where conditions to the model.
   *
   * @param array $where
   *
   * @return void
   */
  protected function applyConditions(array $where)
  {
    foreach ($where as $field => $value) {
      if (is_array($value)) {
        list($field, $condition, $val) = $value;

        $condition = preg_replace('/\s\s+/', ' ', trim($condition));

        $operator = explode(' ', $condition);
        if (count($operator) > 1) {
          $condition = $operator[0];
          $operator = $operator[1];
        } else $operator = null;
        switch (strtoupper($condition)) {
          case 'IN':
            if (!is_array($val)) throw new Exception("Input {$val} mus be an array");
            $this->model = $this->model->whereIn($field, $val);
            break;
          case 'NOTIN':
            if (!is_array($val)) throw new Exception("Input {$val} mus be an array");
            $this->model = $this->model->whereNotIn($field, $val);
            break;
          case 'DATE':
            if (!$operator) $operator = '=';
            $this->model = $this->model->whereDate($field, $operator, $val);
            break;
          case 'DAY':
            if (!$operator) $operator = '=';
            $this->model = $this->model->whereDay($field, $operator, $val);
            break;
          case 'MONTH':
            if (!$operator) $operator = '=';
            $this->model = $this->model->whereMonth($field, $operator, $val);
            break;
          case 'YEAR':
            if (!$operator) $operator = '=';
            $this->model = $this->model->whereYear($field, $operator, $val);
            break;
          case 'EXISTS':
            if (!($val instanceof Closure)) throw new Exception("Input {$val} must be closure function");
            $this->model = $this->model->whereExists($val);
            break;
          case 'HAS':
            if (!($val instanceof Closure)) throw new Exception("Input {$val} must be closure function");
            $this->model = $this->model->whereHas($field, $val);
            break;
          case 'HASMORPH':
            if (!($val instanceof Closure)) throw new Exception("Input {$val} must be closure function");
            $this->model = $this->model->whereHasMorph($field, $val);
            break;
          case 'DOESNTHAVE':
            if (!($val instanceof Closure)) throw new Exception("Input {$val} must be closure function");
            $this->model = $this->model->whereDoesntHave($field, $val);
            break;
          case 'DOESNTHAVEMORPH':
            if (!($val instanceof Closure)) throw new Exception("Input {$val} must be closure function");
            $this->model = $this->model->whereDoesntHaveMorph($field, $val);
            break;
          case 'BETWEEN':
            if (!is_array($val)) throw new Exception("Input {$val} mus be an array");
            $this->model = $this->model->whereBetween($field, $val);
            break;
          case 'BETWEENCOLUMNS':
            if (!is_array($val)) throw new Exception("Input {$val} mus be an array");
            $this->model = $this->model->whereBetweenColumns($field, $val);
            break;
          case 'NOTBETWEEN':
            if (!is_array($val)) throw new Exception("Input {$val} mus be an array");
            $this->model = $this->model->whereNotBetween($field, $val);
            break;
          case 'NOTBETWEENCOLUMNS':
            if (!is_array($val)) throw new Exception("Input {$val} mus be an array");
            $this->model = $this->model->whereNotBetweenColumns($field, $val);
            break;
          case 'RAW':
            $this->model = $this->model->whereRaw($val);
            break;
          default:
            $this->model = $this->model->where($field, $condition, $val);
        }
      } else {
        $this->model = $this->model->where($field, '=', $value);
      }
    }
  }

  /**
   * @throws Exception
   */
  public function resetModel()
  {
    $this->makeModel();
  }

  /**
   * Reset Query Scope
   *
   * @return $this
   */
  public function resetScope()
  {
    $this->scopeQuery = null;

    return $this;
  }

  public function getModel()
  {
    return $this->model;
  }

  public function getFillableColumns()
  {
    $columnsArray = [];

    if ($this->model instanceof \Illuminate\Database\Eloquent\Builder) {
      $columnsArray = $this->model->getModel()->getFillable();
    } else {
      $columnsArray = $this->model->getFillable();
    }

    return $columnsArray;
  }

  public function setConnectionResolver()
  {
    if (is_null($this->getModel()->getConnectionResolver())) {
      $this->getModel()->setConnectionResolver(app()['db']);
    }
  }

  /**
   * Change database connection
   *
   * @return $this
   */
  public function setConnection($connectionName)
  {
    $this->model->setConnection($connectionName);

    return $this;
  }
}
