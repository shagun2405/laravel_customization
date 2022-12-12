<?php

namespace Webkul\Galaxy\Helpers;

use Webkul\Product\Helpers\Review;

class Helper extends Review
{
    /**
     * Create a helper instance.
     *
     * @return void
     */
    public function __construct(
    )
    {
    }

    /**
     * Get messages from session.
     *
     * @return void
     */
    public function getMessage()
    {
        $message = [
            'message'      => '',
            'messageType'  => '',
            'messageLabel' => '',
        ];

        if ($message['message'] = session('success')) {
            $message['messageType'] = 'alert-success';
            $message['messageLabel'] = __('velocity::app.shop.general.alert.success');
        } elseif ($message['message'] = session('warning')) {
            $message['messageType'] = 'alert-warning';
            $message['messageLabel'] = __('velocity::app.shop.general.alert.warning');
        } elseif ($message['message'] = session('error')) {
            $message['messageType'] = 'alert-danger';
            $message['messageLabel'] = __('velocity::app.shop.general.alert.error');
        } elseif ($message['message'] = session('info')) {
            $message['messageType'] = 'alert-info';
            $message['messageLabel'] = __('velocity::app.shop.general.alert.info');
        }

        return $message;
    }

    /**
     * Get json translations.
     *
     * @return array
     */
    public function jsonTranslations()
    {
        $currentLocale = app()->getLocale();

        $path = __DIR__ . "/../Resources/lang/$currentLocale/app.php";

        if (is_string($path) && is_readable($path)) {
            return include $path;
        } else {
            $currentLocale = 'en';

            $path = __DIR__ . "/../Resources/lang/$currentLocale/app.php";

            return include $path;
        }
    }
}
