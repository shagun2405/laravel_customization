<?php

namespace Webkul\GalaxyClinic\Http\Controllers\Shop\Account;

use Webkul\GalaxyClinic\DataGrids\Shop\ProductDataGrid;
use Webkul\GalaxyClinic\Http\Controllers\Shop\Controller;

/**
 * Product controller
 *
 * @author    Anmol Singh Chauhan <anmol.chauhan207@webkul.in>
 * @copyright 2022 Webkul Software Pvt Ltd (http://www.webkul.com)
*/
class ServiceController extends Controller
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
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $isSeller = $this->isSeller();

        if (! $isSeller) {
            return redirect()->route('marketplace.account.seller.create');
        }

        if (request()->ajax()) {
            return app(ProductDataGrid::class)->toJson();
        }

        return view($this->_config['view']);
    }
}
