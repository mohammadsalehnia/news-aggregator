<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

trait ModelHelperTesting
{
    abstract protected function model(): Model;

    /**
     * Basic feature test for models.
     *
     * @return void
     */
    public function testInsertData(): void
    {
        $model = $this->model();
        $table = $model->getTable();

        $data = $model::factory()->make()->toArray();

        $model::create($data);

        $this->assertDatabaseHas($table, $data);
    }

}
