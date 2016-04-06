<?php

namespace Web\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Admin
 *
 * @ORM\Table(name="admin")
 * @ORM\Entity(repositoryClass="Web\SecurityBundle\Repository\AdminRepository")
 */
class Admin extends BaseUser
{
}
