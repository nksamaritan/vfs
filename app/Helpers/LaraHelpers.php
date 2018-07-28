<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Permission;


if (!function_exists('GetUserPermissions')) {
    /*
        *  get Users permission who logged in by call this func GetUserPermissions()
        *
        *  @return array
        * */
    function GetUserPermissions()
    {
        $permission = new Permission();
        $userPermission = array();
        foreach (Auth::user()->UserPermission as $row) {
            $userPermission[] = $permission->getPermissionByField($row->permission_id, 'id')->code;
        }
        if (in_array(Auth::user()->role_id, [1, 2])) {
            $userPermission[] = "system_log";
            $userPermission[] = "country_management";
            $userPermission[] = "state_management";
            $userPermission[] = "division_management";
            $userPermission[] = "service_management";
            $userPermission[] = "sla_management";
            $userPermission[] = "client_contact_management";
            $userPermission[] = "placement_management";
            $userPermission[] = "settings";
            // $userPermission[] = "industry_management";
        }

        return $userPermission;
    }
}

if (!function_exists('logError')) {
    function logError($label = null, $description = null, $context = array())
    {

        $return = $this->getLoggerBasicData($label, $description);

        if (isset($context['file']) && $context['file'] !== null) {
            $return['file'] = $context['file'];
            unset($context['file']);
        }

        if (isset($context['line']) && $context['line'] !== null) {
            $return['line'] = $context['line'];
            unset($context['line']);
        }

        if (is_array($context) && !empty($context)) {
            $return['params'] = $context;
        }

        Log::Error('', $return);
    }
}


if (!function_exists('getLoggerBasicData')) {

    /**
     * Returns the basic data for logging
     * Below parameters will be returned
     * session
     * pid
     * ip_address
     * host
     * referer
     * request_uri
     * guid
     *
     * @param null $label
     * @param null $description
     * @return array
     */
    function getLoggerBasicData($label = null, $description = null)
    {

        $return = array();

        if (isset($label) && $label !== null) {
            $return['label'] = $label;
        }

        if (isset($description) && $description !== null) {
            $return['description'] = $description;
        }

        if (isset($_COOKIE['__crm_guid']) && $_COOKIE['__crm_guid'] !== null) {
            $return['guid'] = $_COOKIE['__crm_guid'];
        }

        $return['pid'] = Request::Header('x-crm-track-pid');
        $return['tid'] = Request::Header('x-crm-track-tid');

        if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] !== null) {
            $return['host'] = $_SERVER['HTTP_HOST'];
        }

        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== null) {
            $return['referer'] = $_SERVER['HTTP_REFERER'];
        }

        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] !== null) {
            $return['request_uri'] = $_SERVER['REQUEST_URI'];
        }

        return $return;
    }
}