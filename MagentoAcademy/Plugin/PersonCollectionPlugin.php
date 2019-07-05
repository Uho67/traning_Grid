<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 16.06.19
 * Time: 23:03
 */

namespace SysPerson\MagentoAcademy\Plugin;

use SysPerson\MagentoAcademy\Api\Data\PersonsInterface;


class PersonCollectionPlugin
{
    public function  aftergetItems($object,$return)
    {


        foreach ($return as $item){

            $item->setName("Plugin Collection : ".$item->getName(),PersonsInterface::NAME_FIELD);

        }
        return $return;
    }
}