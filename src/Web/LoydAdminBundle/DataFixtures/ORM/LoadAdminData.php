<?php

namespace Web\LoydAdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Web\SecurityBundle\Entity\Admin;

class LoadAdminData implements FixtureInterface, ContainerAwareInterface
{
    public function load(ObjectManager $manager)
    {
        for($i=0;$i<10;$i++){
        $admin = new Admin();
        $admin->setUsername('admin'.$i);
        $admin->setName('admin'.$i.$i);
        $admin->setSurname('admin'.$i.$i.$i);
        
        //password
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($admin, '123456');
        $admin->setPassword($password);
        //
        $admin->setEmail('admin'.$i.'@mail.ru');
        $admin->setIsActive('1');
        $admin->setRole('ROLE_ADMIN');
       
        $manager->persist($admin);
        $manager->flush();
        unset($admin);
        
        
        
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($admin, '123456');
        $admin->setPassword($password);
        
        $admin->setEmail('q'.$i.'@mail.ru');
        $admin->getIsActive('1');
        $admin->setRole('ROLE_ADMIN');
       
        $manager->persist($admin);
        $manager->flush();
        unset($admin);
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