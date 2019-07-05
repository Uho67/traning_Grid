<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 17.06.19
 * Time: 12:56
 */

namespace SysPerson\MagentoAcademy\Api\PersonFront;


interface ConfigInterface
{
       const TITLE_CONFIG_PATH = 'person_front/general/title';
       const MESSAGE_CONFIG_PATH = 'person_front/general/message';



    public function getMessage();
    public function getTitle();
}