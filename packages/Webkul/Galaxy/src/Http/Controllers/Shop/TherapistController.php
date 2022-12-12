<?php

namespace Webkul\Galaxy\Http\Controllers\Shop;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\User\Repositories\AdminRepository;
use Webkul\User\Repositories\RoleRepository;

class TherapistController extends Controller
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
     * Display login page.
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Display a listing of the resource.
     */
    public function view()
    {
        return view($this->_config['view']);
    }

    public function verify()
    {
        dd(request());
    }

}
