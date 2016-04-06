<?php

namespace Web\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Admin
 *
 * @ORM\Table(name="admin",indexes={@ORM\Index(name="name_email_idx", columns={"name", "email"})})
 * @ORM\Entity(repositoryClass="Web\SecurityBundle\Repository\AdminRepository")
 */
class Admin extends BaseUser
{
}
