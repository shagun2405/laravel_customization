<?php

namespace Webkul\Galaxy\Http\Controllers\Shop;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\User\Repositories\AdminRepository;
use Webkul\User\Repositories\RoleRepository;

class PatientController extends Controller
{
   
     /**
     * Contains route related configuration.
     *
     * @var array
     */
    protected $_config;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\User\Repositories\AdminRepository  $adminRepository
     * @param  \Webkul\User\Repositories\RoleRepository  $roleRepository
     * @return void
     */
    public function __construct(
        protected AdminRepository $adminRepository,
        protected RoleRepository $roleRepository
    )
    {
        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     */
    public function view($id)
    {
        return view($this->_config['view'],compact('id'));
    }

}
