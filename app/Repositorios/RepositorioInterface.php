<?php namespace App\Repositorios;

interface RepositorioInterface {

    public function all();

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);

    public function show(int $id);

    public function paginate(int $take, array $columns = array('*'));

}