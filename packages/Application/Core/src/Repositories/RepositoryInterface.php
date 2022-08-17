<?php

namespace Application\Core\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface {
    public function getModel();
    public function getNameTable();
    public function getViewModel();
    public function all($columns = array('*'));
    public function getById($id, $columns = array('*'));
    public function getByColumn($column,$attributes,$columns = array('*'));
    public function where($column,$attribute);
    public function getLang();
    public function create(array $attributes);
    public function updateOrCreate(array $attributes,array $values);
    public function lists($column);
    public function paginate($perPage = 15, $columns = array('*'));
    public function update(array $attributes, $id, $attribute="id");
    public function with($array = []);
    public function destroy($id);
    public function deleteBy($condition = array('*'));


}