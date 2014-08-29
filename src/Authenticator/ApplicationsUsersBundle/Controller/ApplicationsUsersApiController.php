<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 29.08.14
 * Time: 1:45
 */

namespace Authenticator\ApplicationsUsersBundle\Controller;

use Authenticator\ApiSecurityBundle\Logger\LoggingInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ApplicationsUsersApiController extends Controller implements LoggingInterface
{
    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @Route(
     *      "/clients/api/v1/account/{application_id}/",
     *      requirements={"application_id"="\d+"},
     *      name="clients_api_v1_set_account"
     * )
     *
     * @Method({"POST", "PUT"})
     */
    public function setAccountAction(Request $request)
    {
        return new JsonResponse();
    }

    /**
     * @param Request $request
     * @param $account_type
     * @return JsonResponse
     *
     * @Route(
     *      "/clients/api/v1/account/personal_data/{application_id}/{account_type}/",
     *      requirements={"application_id"="\d+", "account_type"="\d+"},
     *      defaults={"account_type"=0},
     *      name="clients_api_v1_set_account_personal_data"
     * )
     *
     * @Route(
     *      "/clients/api/v1/account/personal_data/{application_id}/",
     *      requirements={"application_id"="\d+"},
     *      defaults={"account_type"=0},
     *      name="clients_api_v1_set_account_personal_data"
     * )
     *
     * @Method({"POST", "PUT"})
     */
    public function setAccountPersonalData(Request $request, $account_type)
    {
        return new JsonResponse();
    }

    /**
     * @param Request $request
     * @param $account_id
     * @return JsonResponse
     *
     * @Route(
     *      "/clients/api/v1/account/personal_data/{application_id}/{account_id}/",
     *      requirements={"application_id"="\d+", "account_id"="\d+"},
     *      name="clients_api_v1_get_account_personal_data"
     * )
     */
    public function getAccountPersonalData(Request $request, $account_id)
    {
        return new JsonResponse();
    }
} 