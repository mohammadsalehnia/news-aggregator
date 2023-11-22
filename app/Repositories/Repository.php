<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
abstract class Repository
{
    protected $model;

    public function __construct()
    {
        $this->model = app($this->model());
    }

    abstract public function model(): string;

    public function all(): Collection
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function exists($id): bool
    {
        return $this->model->where('id', $id)->exists();
    }
}
