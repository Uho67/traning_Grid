<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 16.06.19
 * Time: 22:04
 */

namespace SysPerson\MagentoAcademy\Plugin;
use SysPerson\MagentoAcademy\Api\Data\PersonsInterface;





class PersonListPlugin
{

    public function aftergetActualPersonsList($subject,$return)
    {
        foreach ($return->getItems() as $item){

            $item->setName("My name : ".$item->getName(),PersonsInterface::NAME_FIELD);
            $item->setSurname("My surname : ".$item->getSurname(),PersonsInterface::SURNAME_FIELD);

        }
        return $return;
    }
}