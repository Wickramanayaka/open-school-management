<?php

namespace App;



class Chart
{

    Private $chart_string = '';
    Private $col = [];
    private $row = [];

    public function _construct()
    {
       
    }
    public function col(Array $cols)
    {
       foreach ($cols as $key => $value) {
           $this->col[] = [
               'id' => "",
               'label' => $value[0],
               "pattern" => "",
               "type" => $value[1]
           ];
       }
    }
    public function row(Array $rows)
    {
        foreach ($rows as $key => $value) {
           $row[] = ["v" => $value];
       }
       $this->row[] = [
           "c" => $row
       ];
    }

    public function toString()
    {
        $chart = [
            "cols" => $this->col,
            "rows" => $this->row
        ];
        return json_encode($chart);
    }





}
