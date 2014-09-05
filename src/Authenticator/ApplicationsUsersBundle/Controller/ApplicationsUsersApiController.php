<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 29.08.14
 * Time: 1:45
 */

namespace Authenticator\ApplicationsUsersBundle\Controller;

use Authenticator\ApiSecurityBundle\Logger\LoggingInterface;
use Authenticator\ApplicationsUsersBundle\Entity\ApplicationsUsers;
use Authenticator\ApplicationsUsersBundle\Entity\IndividualPersonalData;
use Authenticator\ApplicationsUsersBundle\Entity\LegalEntityPersonalData;
use Authenticator\ApplicationsUsersBundle\Exception\JsonContentException;
use Authenticator\ApplicationsUsersBundle\Helper\JsonContent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class ApplicationsUsersApiController extends Controller implements LoggingInterface
{
    /**
     * @param Request $request
     * @param $application_id
     * @return Response
     *
     * @Route(
     *      "/clients/api/v1/account/{application_id}/",
     *      requirements={"application_id"="\d+"},
     *      name="clients_api_v1_set_account"
     * )
     *
     * @Route(
     *      "/clients/api/v1/account/{application_id}",
     *      requirements={"application_id"="\d+"},
     *      name="clients_api_v1_set_account_without_slash"
     * )
     *
     * @Method({"POST", "PUT"})
     */
    public function setAccountAction(Request $request, $application_id)
    {
        $response = new Response();
        $validator = $this->container->get('validator');

        try{
            $requestJsonContent = JsonContent::getJsonObject($request);
        }
        catch(JsonContentException $e){
            return $response->setStatusCode(Response::HTTP_BAD_REQUEST)->setContent($e->getMessage());
        }
        catch(\Exception $e){
            return $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->setContent($e->getMessage());
        }

        foreach($requestJsonContent as $item){
            if(empty($item['id'])){
                return $response->setStatusCode(Response::HTTP_BAD_REQUEST)->setContent('В пакете данных переданном в запросе не указан обзательный параметр "id".');
            }
        }

        foreach($requestJsonContent as $item){
            $applicationAccount = $this->getDoctrine()->getManager()
                ->getRepository('AuthenticatorApplicationsUsersBundle:ApplicationsUsers')
                ->findOneBy(
                    ['applicationId' => $application_id, 'applicationUserId' => $item['id']]
                );

            if(!$applicationAccount){
                $applicationAccount = new ApplicationsUsers();
            }

            $applicationAccount->setApplicationUserId($item['id']);
            $applicationAccount->setApplicationId($this->getUser());
            $applicationAccount->setAccountType(
                !empty($item['account_type']) ? $item['account_type'] : 0
            );
            $applicationAccount->setAccountName(
                !empty($item['account_name']) ? $item['account_name'] : ''
            );
            $applicationAccount->setAccountValue(
                !empty($item['account_value']) ? $item['account_value'] : ''
            );
            $applicationAccount->setAuthorisationType(
                !empty($item['authorisation_type']) ? $item['authorisation_type'] : ''
            );
            $applicationAccount->setPasswordHash(
                !empty($item['password_hash']) ? $item['password_hash'] : ''
            );
            $applicationAccount->setPasswordHashType(
                !empty($item['password_hash_type']) ? $item['password_hash_type'] : ''
            );

            $violations = $validator->validate($applicationAccount);

            if(count($violations) > 0){
                return $response->setStatusCode(Response::HTTP_BAD_REQUEST)->setContent(self::getJsonErrors($violations));
            }

            $this->getDoctrine()->getManager()->persist($applicationAccount);
        }

        $this->getDoctrine()->getManager()->flush();

        return $response->setContent('Операция выполнена успешно.');
    }

    /**
     * @param Request $request
     * @param $application_id
     * @param $account_type
     * @return Response
     *
     * @Route(
     *      "/clients/api/v1/account/personal_data/{application_id}/{account_type}/",
     *      requirements={"application_id"="\d+", "account_type"="\d+"},
     *      defaults={"account_type"=0},
     *      name="clients_api_v1_set_account_personal_data"
     * )
     *
     * @Route(
     *      "/clients/api/v1/account/personal_data/{application_id}/{account_type}",
     *      requirements={"application_id"="\d+", "account_type"="\d+"},
     *      defaults={"account_type"=0},
     *      name="clients_api_v1_set_account_personal_data_without_slash"
     * )
     *
     * @Route(
     *      "/clients/api/v1/account/personal_data/{application_id}/",
     *      requirements={"application_id"="\d+"},
     *      defaults={"account_type"=0},
     *      name="clients_api_v1_set_account_personal_data_without_account_type"
     * )
     *
     * @Route(
     *      "/clients/api/v1/account/personal_data/{application_id}",
     *      requirements={"application_id"="\d+"},
     *      defaults={"account_type"=0},
     *      name="clients_api_v1_set_account_personal_data_without_account_type_without_slash"
     * )
     *
     * @Method({"POST", "PUT"})
     */
    public function setAccountPersonalData(Request $request, $application_id, $account_type)
    {
        $response = new Response();

        $validator = $this->container->get('validator');

        try{
            $requestJsonContent = JsonContent::getJsonObject($request);
        }
        catch(JsonContentException $e){
            return $response->setStatusCode(Response::HTTP_BAD_REQUEST)->setContent($e->getMessage());
        }
        catch(\Exception $e){
            return $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->setContent($e->getMessage());
        }

        foreach($requestJsonContent as $item){
            if(empty($item['account_id'])){
                return $response->setStatusCode(Response::HTTP_BAD_REQUEST)->setContent('В пакете данных переданном в запросе не указан обзательный параметр "account_id".');
            }
        }

        foreach($requestJsonContent as $item){
            $applicationAccount = $this->getDoctrine()->getManager()
                ->getRepository('AuthenticatorApplicationsUsersBundle:ApplicationsUsers')
                ->findOneBy(
                    ['applicationId' => $application_id, 'applicationUserId' => $item['account_id']]
                );

            if(!$applicationAccount){
                return $response->setStatusCode(Response::HTTP_NOT_FOUND)->setContent('Пользователь с указанным идентификатором "account_id" для указанной внешней системы не найден.');
            }

            if($applicationAccount->getAccountType() != $account_type){
                return $response->setStatusCode(Response::HTTP_BAD_REQUEST)->setContent('Указан не корректный тип пользователей для загрузки данных.');
            }

            if($account_type == 0){
                $personalData = $this->setIndividualPersonalData($applicationAccount, $item);
            }
            else{
                $personalData =  $this->setLegalEntityPersonalData($applicationAccount, $item);
            }

            if($personalData instanceof Response){
                return $personalData;
            }

            $violations = $validator->validate($personalData);

            if(count($violations) > 0){
                return $response->setStatusCode(Response::HTTP_BAD_REQUEST)->setContent(self::getJsonErrors($violations));
            }

            $this->getDoctrine()->getManager()->persist($personalData);
        }

        $this->getDoctrine()->getManager()->flush();

        return $response->setContent('Операция выполнена успешно.');
    }

    /**
     * @param $application_id
     * @param $account_id
     * @return Response
     *
     * @Route(
     *      "/clients/api/v1/account/personal_data/{application_id}/{account_id}/",
     *      requirements={"application_id"="\d+", "account_id"="\d+"},
     *      name="clients_api_v1_get_account_personal_data"
     * )
     *
     * @Route(
     *      "/clients/api/v1/account/personal_data/{application_id}/{account_id}",
     *      requirements={"application_id"="\d+", "account_id"="\d+"},
     *      name="clients_api_v1_get_account_personal_data_without_slash"
     * )
     *
     * @Method({"GET"})
     */
    public function getAccountPersonalData($application_id, $account_id)
    {
        $response = new Response();

        $applicationAccount = $this->getDoctrine()->getManager()
            ->getRepository('AuthenticatorApplicationsUsersBundle:ApplicationsUsers')
            ->findOneBy(
                ['applicationId' => $application_id, 'applicationUserId' => $account_id]
            );

        if(!$applicationAccount){
            return $response->setStatusCode(Response::HTTP_NOT_FOUND)
                ->setContent('Пользователь с указанным значением параметра "account_id" для указанного внешнего проекта не найден.');
        }

        if($applicationAccount->getAccountType() == 0){
            $accountPersonalData = $applicationAccount->getAccountIndividual();
        }
        else{
            $accountPersonalData = $applicationAccount->getAccountLegalEntity();
        }

        if(!$accountPersonalData){
            return $response->setStatusCode(Response::HTTP_NOT_FOUND)
                ->setContent('Персональные данные для пользователя с указанным значением параметра "account_id" не найдены.');
        }

        if($applicationAccount->getAccountType() == 0){
            $responseContent = [
                'account_id' => $applicationAccount->getApplicationUserId(),
                'last_name' => $accountPersonalData->getLastName(),
                'first_name' => $accountPersonalData->getFirstName(),
                'middle_name' => $accountPersonalData->getMiddleName(),
                'birthday' => $accountPersonalData->getBirthday()->format('Y-m-d'),
                'passport_series' => $accountPersonalData->getPassportSeries(),
                'passport_number' => $accountPersonalData->getPassportNumber(),
                'date_of_issue' => $accountPersonalData->getDateOfIssue()->format('Y-m-d'),
                'place_of_issue' => $accountPersonalData->getPlaceOfIssue(),
                'contact_phone' => $accountPersonalData->getContactPhone()
            ];
        }
        else{
            $responseContent = [
                'account_id' => $applicationAccount->getApplicationUserId(),
                'organisation_type' => $accountPersonalData->getOrganisationType(),
                'organisation_name' => $accountPersonalData->getOrganisationName(),
                'legal_address' => [
                    'zip' => $accountPersonalData->getLegalAddressZip(),
                    'country' => $accountPersonalData->getLegalAddressCountry(),
                    'state' => $accountPersonalData->getLegalAddressState(),
                    'city' => $accountPersonalData->getLegalAddressCity(),
                    'street' => $accountPersonalData->getLegalAddressStreet(),
                    'house' => $accountPersonalData->getLegalAddressHouse(),
                    'build' => $accountPersonalData->getLegalAddressBuild(),
                    'office' => $accountPersonalData->getLegalAddressOffice()
                ],
                'actual_address' => [
                    'zip' => $accountPersonalData->getActualAddressZip(),
                    'country' => $accountPersonalData->getActualAddressCountry(),
                    'state' => $accountPersonalData->getActualAddressState(),
                    'city' => $accountPersonalData->getActualAddressCity(),
                    'street' => $accountPersonalData->getActualAddressStreet(),
                    'house' => $accountPersonalData->getActualAddressHouse(),
                    'build' => $accountPersonalData->getActualAddressBuild(),
                    'office' => $accountPersonalData->getActualAddressOffice()
                ],
                'email' => $accountPersonalData->getEmail(),
                'phone' => $accountPersonalData->getPhone(),
                'inn' => $accountPersonalData->getInn(),
                'kpp' => $accountPersonalData->getKpp(),
                'okved' => $accountPersonalData->getOkved(),
                'okpo' => $accountPersonalData->getOkpo(),
                'bank' =>  [
                    'name' => $accountPersonalData->getBankName(),
                    'bik' => $accountPersonalData->getBankBik(),
                    'correspondent_account' => $accountPersonalData->getBankCorrespondentAccount(),
                    'checking_account' => $accountPersonalData->getBankCheckingAccount()
                ],
                'organisation_head' =>  [
                    'last_name' => $accountPersonalData->getOrganisationHeadLastName(),
                    'first_name' => $accountPersonalData->getOrganisationHeadFirstName(),
                    'middle_name' => $accountPersonalData->getOrganisationHeadMiddleName(),
                    'base_activities' => $accountPersonalData->getOrganisationHeadBaseActivities(),
                    'post' => $accountPersonalData->getOrganisationHeadPost()
                ]
            ];
        }

        return $response->setContent(json_encode($responseContent));
    }

    protected function setIndividualPersonalData(ApplicationsUsers $applicationAccount, $requestJsonItem)
    {
        try{
            $birthday = new \DateTime($requestJsonItem['birthday']);
            $dateOfIssue = new \DateTime($requestJsonItem['date_of_issue']);
        }
        catch(\Exception $e){
            return new Response('Дата указана в не корректном формате.', Response::HTTP_BAD_REQUEST);
        }

        $personalData = !$applicationAccount->getAccountIndividual() ? new IndividualPersonalData() : $applicationAccount->getAccountIndividual();

        $personalData->setApplicationsUser($applicationAccount);
        $personalData->setLastName(
            !empty($requestJsonItem['last_name']) ? $requestJsonItem['last_name'] : $personalData->getLastName()
        );
        $personalData->setFirstName(
            !empty($requestJsonItem['first_name']) ? $requestJsonItem['first_name'] : $personalData->getFirstName()
        );
        $personalData->setMiddleName(
            !empty($requestJsonItem['middle_name']) ? $requestJsonItem['middle_name'] : $personalData->getMiddleName()
        );
        $personalData->setBirthday(
            !empty($requestJsonItem['birthday']) ? $birthday : $personalData->getBirthday()
        );
        $personalData->setPassportSeries(
            !empty($requestJsonItem['passport_series']) ? $requestJsonItem['passport_series'] : $personalData->getPassportSeries()
        );
        $personalData->setPassportNumber(
            !empty($requestJsonItem['passport_number']) ? $requestJsonItem['passport_number'] : $personalData->getPassportNumber()
        );
        $personalData->setDateOfIssue(
            !empty($requestJsonItem['date_of_issue']) ? $dateOfIssue : $personalData->getDateOfIssue()
        );
        $personalData->setPlaceOfIssue(
            !empty($requestJsonItem['place_of_issue']) ? $requestJsonItem['place_of_issue'] : $personalData->getContactPhone()
        );
        $personalData->setContactPhone(
            !empty($requestJsonItem['contact_phone']) ? $requestJsonItem['contact_phone'] : $personalData->getPlaceOfIssue()
        );

        return $personalData;
    }

    protected function setLegalEntityPersonalData(ApplicationsUsers $applicationAccount, $requestJsonItem)
    {
        $personalData = !$applicationAccount->getAccountLegalEntity() ? new LegalEntityPersonalData() : $applicationAccount->getAccountLegalEntity();

        $personalData->setApplicationsUser($applicationAccount);
        $personalData->setOrganisationType(
            !empty($requestJsonItem['organisation_type']) ? $requestJsonItem['organisation_type'] : $personalData->getOrganisationType()
        );
        $personalData->setOrganisationName(
            !empty($requestJsonItem['organisation_name']) ? $requestJsonItem['organisation_name'] : $personalData->getOrganisationName()
        );

        if(isset($requestJsonItem['legal_address'])){
            $personalData->setLegalAddressZip(
                !empty($requestJsonItem['legal_address']['zip']) ? $requestJsonItem['legal_address']['zip'] : $personalData->getLegalAddressZip()
            );
            $personalData->setLegalAddressCountry(
                !empty($requestJsonItem['legal_address']['country']) ? $requestJsonItem['legal_address']['country'] : $personalData->getLegalAddressCountry()
            );
            $personalData->setLegalAddressState(
                !empty($requestJsonItem['legal_address']['state']) ? $requestJsonItem['legal_address']['state'] : $personalData->getLegalAddressState()
            );
            $personalData->setLegalAddressCity(
                !empty($requestJsonItem['legal_address']['city']) ? $requestJsonItem['legal_address']['city'] : $personalData->getLegalAddressCity()
            );
            $personalData->setLegalAddressStreet(
                !empty($requestJsonItem['legal_address']['street']) ? $requestJsonItem['legal_address']['street'] : $personalData->getLegalAddressStreet()
            );
            $personalData->setLegalAddressHouse(
                !empty($requestJsonItem['legal_address']['house']) ? $requestJsonItem['legal_address']['house'] : $personalData->getLegalAddressHouse()
            );
            $personalData->setLegalAddressBuild(
                !empty($requestJsonItem['legal_address']['build']) ? $requestJsonItem['legal_address']['build'] : $personalData->getLegalAddressBuild()
            );
            $personalData->setLegalAddressOffice(
                !empty($requestJsonItem['legal_address']['office']) ? $requestJsonItem['legal_address']['office'] : $personalData->getLegalAddressOffice()
            );
        }

        if(isset($requestJsonItem['actual_address'])){
            $personalData->setActualAddressZip(
                !empty($requestJsonItem['actual_address']['zip']) ? $requestJsonItem['actual_address']['zip'] : $personalData->getActualAddressZip()
            );
            $personalData->setActualAddressCountry(
                !empty($requestJsonItem['actual_address']['country']) ? $requestJsonItem['actual_address']['country'] : $personalData->getActualAddressCountry()
            );
            $personalData->setActualAddressState(
                !empty($requestJsonItem['actual_address']['state']) ? $requestJsonItem['actual_address']['state'] : $personalData->getActualAddressState()
            );
            $personalData->setActualAddressCity(
                !empty($requestJsonItem['actual_address']['city']) ? $requestJsonItem['actual_address']['city'] : $personalData->getActualAddressCity()
            );
            $personalData->setActualAddressStreet(
                !empty($requestJsonItem['actual_address']['street']) ? $requestJsonItem['actual_address']['street'] : $personalData->getActualAddressStreet()
            );
            $personalData->setActualAddressHouse(
                !empty($requestJsonItem['actual_address']['house']) ? $requestJsonItem['actual_address']['house'] : $personalData->getActualAddressHouse()
            );
            $personalData->setActualAddressBuild(
                !empty($requestJsonItem['actual_address']['build']) ? $requestJsonItem['actual_address']['build'] : $personalData->getActualAddressBuild()
            );
            $personalData->setActualAddressOffice(
                !empty($requestJsonItem['actual_address']['office']) ? $requestJsonItem['actual_address']['office'] : $personalData->getActualAddressOffice()
            );
        }

        $personalData->setEmail(
            !empty($requestJsonItem['email']) ? $requestJsonItem['email'] : $personalData->getEmail()
        );
        $personalData->setPhone(
            !empty($requestJsonItem['phone']) ? $requestJsonItem['phone'] : $personalData->getPhone()
        );
        $personalData->setInn(
            !empty($requestJsonItem['inn']) ? $requestJsonItem['inn'] : $personalData->getInn()
        );
        $personalData->setKpp(
            !empty($requestJsonItem['kpp']) ? $requestJsonItem['kpp'] : $personalData->getKpp()
        );
        $personalData->setOkved(
            !empty($requestJsonItem['okved']) ? $requestJsonItem['okved'] : $personalData->getOkved()
        );
        $personalData->setOkpo(
            !empty($requestJsonItem['okpo']) ? $requestJsonItem['okpo'] : $personalData->getOkpo()
        );

        if(isset($requestJsonItem['bank'])){
            $personalData->setBankName(
                !empty($requestJsonItem['bank']['name']) ? $requestJsonItem['bank']['name'] : $personalData->getBankName()
            );
            $personalData->setBankBik(
                !empty($requestJsonItem['bank']['bik']) ? $requestJsonItem['bank']['bik'] : $personalData->getBankBik()
            );
            $personalData->setBankCorrespondentAccount(
                !empty($requestJsonItem['bank']['correspondent_account']) ? $requestJsonItem['bank']['correspondent_account'] : $personalData->getBankCorrespondentAccount()
            );
            $personalData->setBankCheckingAccount(
                !empty($requestJsonItem['bank']['checking_account']) ? $requestJsonItem['bank']['checking_account'] : $personalData->getBankCheckingAccount()
            );
        }

        if(isset($requestJsonItem['organisation_head'])){
            $personalData->setOrganisationHeadLastName(
                !empty($requestJsonItem['organisation_head']['last_name']) ? $requestJsonItem['organisation_head']['last_name'] : $personalData->getOrganisationHeadLastName()
            );
            $personalData->setOrganisationHeadFirstName(
                !empty($requestJsonItem['organisation_head']['first_name']) ? $requestJsonItem['organisation_head']['first_name'] : $personalData->getOrganisationHeadFirstName()
            );
            $personalData->setOrganisationHeadMiddleName(
                !empty($requestJsonItem['organisation_head']['middle_name']) ? $requestJsonItem['organisation_head']['middle_name'] : $personalData->getOrganisationHeadMiddleName()
            );
            $personalData->setOrganisationHeadBaseActivities(
                !empty($requestJsonItem['organisation_head']['base_activities']) ? $requestJsonItem['organisation_head']['base_activities'] : $personalData->getOrganisationHeadBaseActivities()
            );
            $personalData->setOrganisationHeadPost(
                !empty($requestJsonItem['organisation_head']['post']) ? $requestJsonItem['organisation_head']['post'] : $personalData->getOrganisationHeadPost()
            );
        }

        return $personalData;
    }

    /**
     * @param \Symfony\Component\Validator\ConstraintViolationListInterface $violations
     * @return string
     */
    protected static function getJsonErrors($violations)
    {
        $errors = '';
        foreach($violations as $violation){
            /* @var \Symfony\Component\Validator\ConstraintViolationInterface $violation */
            $errors .= $violation->getPropertyPath().': '.$violation->getMessage()."\n";
        }

        return $errors;
    }
} 