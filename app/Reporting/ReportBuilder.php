<?php

namespace App\Reporting;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReportBuilder
{
    /**
     * The report type
     */
    protected $type;

    /**
     * The report data
     */
    protected $data;

    public function build($source = 'dummy')
    {
        if ($source == 'db-table') {
            if (!Schema::hasTable($this->type)) {
                throw new \Exception('Cannot report a non existing table');
            } else {
                $this->data = DB::table($this->type)->get();
            }
        } elseif ($source == 'eloquent') {
            $this->data = call_user_func(array('App\\'.$this->type, 'all'));
        } else {
            //build dummy data
            $this->data = [];
            for ($idx = 0; $idx < 5; $idx++) {
                $this->data[] = [
                    $this->type . '_field_1' => mt_rand(5, 500),
                    $this->type . '_field_2' => mt_rand(5, 500)
                ];
            }
        }


        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function toCollection()
    {
        $this->data = collect($this->data);
        return $this;
    }

    public function toArray()
    {
        $this->data = (array)$this->data;
        return $this;
    }

    public function export()
    {
        return $this->data;
    }
}
