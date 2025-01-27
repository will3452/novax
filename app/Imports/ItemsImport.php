<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;

class ItemsImport implements ToModel
{
    public $type = null;
    public $app = null;
    public $status = "Dev";
    public $client = null;
    public function __construct($app, $type, $status, $client)
    {
        $this->type = $type;
        $this->app = $app;
        $this->status = $status;
        $this->client = $client;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Item([
            'task' => $row[0],
            'type' => $this->type ?? $row[1],
            'status' => $this->status ?? $row[2],
            'application' => $this->app,
            'client' => $this->client,
        ]);
    }
}
