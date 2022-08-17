<?php namespace Application\Core\Repositories;

    use Application\Core\Repositories\RepositoryInterface as RepositoryInterface;
    use Illuminate\Database\Eloquent\Model;

abstract class RepositoryEloquent implements RepositoryInterface {

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getNameTable() {

        return $this->model->getTable();

    }

    public function getViewModel() {

        
        if (strstr($this->model->getTable(), '_')) {

           $nameView = explode('_',$this->model->getTable());

            return $nameView[0].'.'.$nameView[1];
        } 

           return $this->model->getTable(); 
    }

    public function all($columns = array('*')) {

        return $this->model->all($columns);

    }


    public function getById($id,$columns = array('*')) {

        return $this->model->findOrFail($id);

    }


    public function getByColumn($column,$attributes,$columns = array('*')) {
        
     return $this->model->where($column,$attributes)->get($columns);

    }

    public function where($column,$attribute) {

       return $this->model->where($column,$attribute);


    }


    public function getLang() {

      return  $this->model->where('lang_id','=',Session::get('locale-id'));

    }


    public function create(array $attributes) {

        return $this->model->create($attributes);
    }

    public function updateOrCreate(array $attributes,array $values) {

        return $this->model->updateOrCreate($attributes,$values);

    }

    public function save() {

        return $this->model->save();
    }

     public function lists($column)
    {
        return $this->model->get()->lists($column);
    }

    public function paginate($perPage = 15, $columns = array('*')) {

        return $this->model->paginate($perPage, $columns);
        
    }

    public function update(array $data, $id, $attribute="id") {

        return $this->model->where($attribute, '=', $id)->update($data);
    
    }

    public function with($array = []) {

        return $this->model->with($array);

    }

    public function destroy($id) {

        return $this->model->destroy($id);

    }

    public function deleteBy($condition = [])
    {
        return $this->model->where($condition)->delete();
    }

    


}