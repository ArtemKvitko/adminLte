<?php

namespace Web\SecurityBundle\Command;

use Web\SecurityBundle\WebSecurityBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Web\SecurityBundle\Entity;

class UserUpdateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('loyd:user:update')
            ->setDescription('Update user password')
            ->addOption('username', null, InputOption::VALUE_OPTIONAL, 'User\'s login')
            ->addOption('password', null, InputOption::VALUE_OPTIONAL, 'User\'s password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $login = trim($input->getOption('username'));
        if(empty($login)){
            $login = $io->ask('Enter your user\'s login', '', function ($login) {
                if (empty($login)) {
                    throw new \RuntimeException('Login cannot be empty.');
                }

                return $login;
            });
        }
        
        $user = $this->getContainer()->get('doctrine')->getManager()->getRepository("\Web\SecurityBundle\Entity\User")->findOneByUsername($login);
        
        if(!empty($user)){
            $output->writeln('Login "'.$login.'" exists');
        $password = trim($input->getOption('password'));
        if(empty($password)) {
            $password = $io->askHidden('New user\'s password:', function ($password) {
                if (empty($password)) {
                    throw new \RuntimeException('Password cannot be empty.');
                }
                if (strlen($password) < 6) {
                    throw new \RuntimeException('Password has to be longer than 5 characters.');
                }

                return $password;
            });
        } 
        
        $encoder = $this->getContainer()->get('security.encoder_factory')->getEncoder($user);
        $password = $encoder->encodePassword($password, $user->getSalt());
        $user->setPassword($password);

        $manager = $this->getContainer()->get('doctrine')->getManager();
        $manager->merge($user);
        $manager->flush();

        $output->writeln('Password has been updated.');
        }
        else{
            $output->writeln('Login not exists');
        }


    }
}
