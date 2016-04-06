<?php

namespace Web\LoydAdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Web\SecurityBundle\Entity\User;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    public function load(ObjectManager $manager)
    {
        for($i=0;$i<10;$i++){
        $user = new User();
        $user->setUsername('user'.$i);
        $user->setName('user'.$i.$i);
        $user->setSurname('user'.$i.$i.$i);
        
        //password
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, '123456');
        $user->setPassword($password);
        //
        $user->setEmail('user'.$i.'@mail.ru');
        $user->setIsActive('1');
        $user->setRole('ROLE_USER');
       
        $manager->persist($user);
        $manager->flush();
        unset($user);
        
        }
        
    }

     /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

}