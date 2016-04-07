<?php

namespace Web\SecurityBundle\Repository;

class UserRepository extends BaseUserRepository
{
    public function supportsClass($class) {
        return $class === 'Web\SecurityBundle\Entity\User';
    }
}
