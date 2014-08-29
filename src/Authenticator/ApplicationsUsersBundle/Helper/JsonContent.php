<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 29.08.14
 * Time: 17:26
 */

namespace Authenticator\ApplicationsUsersBundle\Helper;

use Authenticator\ApplicationsUsersBundle\Exception\JsonContentException;
use Symfony\Component\HttpFoundation\Request;

class JsonContent
{
    static public function getJsonObject(Request $request)
    {
        if(!$content = $request->getContent()){
            throw new JsonContentException('Запрос не содержит пакета данных.');
        }

        if(!$content = json_decode($content, true)){
            throw new JsonContentException('Запрос содержит не корректный json-пакет данных.');
        }

        return $content;
    }
} 