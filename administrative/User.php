<?php
/**
 * Created by PhpStorm.
 * User: alexiy
 * Date: 1/24/18
 * Time: 8:40 AM
 */

namespace alexiy;


class User
{
    private $name,$group,$address, $telephone;
    public function __construct(string $name,string $group,string $email, string $phone)
    {
        $this->name=$name;
        $this->group=$group;
        $this->address=$email;
        $this->telephone=$phone;
    }

    /**
     * @return string
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }
}