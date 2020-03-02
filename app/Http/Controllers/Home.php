<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sessions as Sessions;

use App\Reporting\ReportBuilder as ReportBuilder;

class Home extends Controller
{
    /**
     * The report builder
     */
    protected $builder;

    /**
     * Create a new controller instance.
     *
     * @param  ReportBuilder  $builder
     * @return void
     * @throws \Exception
     */
    public function index(ReportBuilder $builder){
        $report = $builder->setType('Sessions')->build('dummy')->toCollection()->export();
        dd($report);
    }
}
