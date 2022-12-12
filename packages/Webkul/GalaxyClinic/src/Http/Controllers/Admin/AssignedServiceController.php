<?php

namespace Webkul\GalaxyClinic\Http\Controllers\Admin;

use Webkul\GalaxyClinic\DataGrids\Admin\AssignedServiceDataGrid;
use Webkul\GalaxyClinic\Http\Controllers\Admin\Controller;
/**
 * Product controller
 *
 * @author    Anmol Singh Chauhan <anmol.chauhan207@webkul.in>
 * @copyright 2022 Webkul Software Pvt Ltd (http://www.webkul.com)
*/
class AssignedServiceController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var object
    */
    protected $_config;

    /**
     * Create a new controller instance.
     *
     *
     * @return void
    */
    public function __construct(
    )
    {
        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(AssignedServiceDataGrid::class)->toJson();
        }

        return view($this->_config['view']);
    }
}
