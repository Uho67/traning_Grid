<?php


namespace SysPerson\MagentoAcademy\Api\Data;

interface PersonsInterface
{
    const TABLE_NAME                = 'aaa_my_table_person';

    const ID_FIELD                  = 'person_id';
    const NAME_FIELD               = 'name';
    const SURNAME_FIELD             = 'surname';
    const BIRTH_DATE_FIELD          = 'data_birth';


    const CACHE_TAG                 = 'aaa_my_table_person';

    const REGISTRY_KEY              = 'aaa_my_table_person';

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param string $title
     * @return \SysPerson\MagentoAcademy\Api\Data\PersonsInterface
     */
    public function setName($title);

    /**
     * @return mixed
     */
    public function getSurname();

    /**
     * @param string $name
     * @return \SysPerson\MagentoAcademy\Api\Data\PersonsInterface
     */
    public function setSurname($name);

    /**
     * @return mixed
     */
    public function getBirthDate();

    /**
     * @param \DateTime|string $statDate
     * @return \SysPerson\MagentoAcademy\Api\Data\PersonsInterface
     */
    public function setBirthDate($statDate);



}
