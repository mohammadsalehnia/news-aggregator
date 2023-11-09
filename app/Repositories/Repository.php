<?php

namespace App\Repositories;

abstract class Repository
{
    protected $model;

    public function __construct()
    {
        $this->model = app($this->model());
    }

    abstract public function model(): string;

    public function all()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function exists($id)
    {
        return $this->model->where('id', $id)->exists();
    }
}
