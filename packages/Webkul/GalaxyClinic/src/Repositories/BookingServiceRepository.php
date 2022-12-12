<?php

namespace Webkul\GalaxyClinic\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * Seller Product Reposotory
 *
 * @author    Anmol Singh Chauhan <anmol.chauhan207@webkul.in>
 * @copyright 2022 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class BookingServiceRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\GalaxyClinic\Contracts\BookingService';
    }
}