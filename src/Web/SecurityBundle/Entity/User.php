<?php

namespace Web\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Web\SecurityBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
}
