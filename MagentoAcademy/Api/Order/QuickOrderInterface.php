<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 21:21
 */

namespace SysPerson\MagentoAcademy\Api\Order;


interface QuickOrderInterface
{
    const TABLE_NAME                = 'my_quick_order_table';

    const ID_FIELD                  = 'order_id';
    const NAME_FIELD                = 'name';
    const SKU_FIELD                 = 'sku';
    const EMAIL_FIELD               = 'email';
    const PHONE_FIELD               = 'phone';
    const STATUS_FIELD              = 'status';

    const CACHE_TAG                 = 'my_quick_order_table';

    const REGISTRY_KEY              = 'my_quick_order_table';


    public function getId();

    public function getName();
    public function setName($name);

    public function getSku();
    public function setSku($sku);

    public function getEmail();
    public function setEmail($email);

    public function getPhone();
    public function setPhone($phone);

    public function getStatus();
    public function setStatus($status);
}