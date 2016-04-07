<?php
/*
 * 
 * use in cmd: php app/console doctrine:fixtures:load --append
 * to input in database data ("users and admins")
 * 
 */
namespace Web\LoydAdminBundle\DataFixtures\ORM;

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
        for($i=1; $i <= 10; $i++){
            $user = new User();
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
        }
        
        
        for($i=0;$i<10;$i++){
            $admin = new User();
            $admin->setUsername('admin'.$i);
            $admin->setName('admin'.$i.$i);
            $admin->setSurname('admin'.$i.$i.$i);
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($admin, '123456');
            $admin->setPassword($password);
            $admin->setEmail('admin'.$i.'@mail.ru');
            $admin->setIsActive('1');
            $admin->setRole('ROLE_ADMIN');
            $manager->persist($admin);
        }
        $manager->flush();
        
    }

}