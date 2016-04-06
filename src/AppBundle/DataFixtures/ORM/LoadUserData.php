<?php

namespace AppBundle\DataFixtures\ORM;

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
        $user->setUsername($i);
        
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, '123456');
        $user->setPassword($password);
        
        $user->setEmail('q'.$i.'@mail.ru');
        $user->getIsActive('1');
       
        $manager->persist($user);
        $manager->flush();
        unset($user);
        }
        
//        for($i=0;$i<10;$i++){
//        $admin = new User();
//        $admin->setUsername($i.'admin');
//        
//        $encoder = $this->container->get('security.password_encoder');
//        $password = $encoder->encodePassword($admin, '123456');
//        $admin->setPassword($password);
//        
//        $admin->setEmail('qq'.$i.'@mail.ru');
//        $admin->getIsActive('1');
//       
//        $manager->persist($admin);
//        $manager->flush();
//        unset($admin);
//        }


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