<?php

namespace Web\SecurityBundle\Repository;

class AdminRepository extends BaseUserRepository
{
    public function supportsClass($class) {
        return $class === 'Web\SecurityBundle\Entity\Admin';
    }
}
