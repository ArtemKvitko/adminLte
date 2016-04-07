<?php

namespace Web\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user",indexes={@ORM\Index(name="name_email_idx", columns={"name", "email"})})
 * @ORM\Entity(repositoryClass="Web\SecurityBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    public function __toString() {
        return $this->getUsername();
    }
}
