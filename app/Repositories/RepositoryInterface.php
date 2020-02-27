<?php namespace App\Repositories;

interface RepositoryInterface {

    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete(int $id);

    public function show(int $id);

    public function paginate(int $take, array $columns = array('*'));

}