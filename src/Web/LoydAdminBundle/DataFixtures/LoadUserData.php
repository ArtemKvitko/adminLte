<?php

namespace Web\LoydAdminBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Web\SecurityBundle\Entity\User;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        for($i=0; $i<10; $i++){
            $user->setUsername('user'.$i);
            $user->setName('user'.$i.$i);
            $user->setSurname('user'.$i.$i.$i);
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($user, '123456');
            $user->setEmail('user'.$i.'@mail.ru');
            $user->setIsActive('1');
            $user->setRole('ROLE_USER');
            $user->setPassword($password);
            $manager->persist($user);
            $manager->flush();        
        }
        
    }

}