<?php

/*
 * to create User use this command in cmd:"php app/console loyd:user:create"
 */

namespace Web\SecurityBundle\Command;

use Web\SecurityBundle\WebSecurityBundle;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Web\SecurityBundle\Entity;

class UserCreateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('loyd:user:create')
            ->setDescription('Creates user')
            ->addOption('username', null, InputOption::VALUE_OPTIONAL, 'User\'s login')
            ->addOption('email', null, InputOption::VALUE_OPTIONAL, 'User\'s email')
            ->addOption('name', null, InputOption::VALUE_OPTIONAL, 'User\'s name')
            ->addOption('surname', null, InputOption::VALUE_OPTIONAL, 'User\'s surname')
            ->addOption('password', null, InputOption::VALUE_OPTIONAL, 'User\'s password')
            ->addOption('role', null, InputOption::VALUE_OPTIONAL, 'User\'s role [ROLE_ADMIN]')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $login = trim($input->getOption('username'));
        if(empty($login)){
            $login = $io->ask('New user\'s login', '', function ($login) {
                if (empty($login)) {
                    throw new \RuntimeException('Login cannot be empty.');
                }

                return $login;
            });
        }

        $email = trim($input->getOption('email'));
        if(empty($email)){
            $email = $io->ask('New user\'s email', '', function ($email) {
                if (empty($email)) {
                    throw new \RuntimeException('Email cannot be empty.');
                }

                return $email;
            });
        }

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

        $name = trim($input->getOption('name'));
        if(empty($name)){
            $name = $io->ask('New user\'s name');
        }

        $role = trim($input->getOption('role'));
        if(empty($role)){
            $role = $io->ask('User\'s role', '', function ($role) {
                if (empty($role)) {
                    return $role = 'ROLE_ADMIN';
                }else{
                    return $role;
                }

            });
        }

        $surname = trim($input->getOption('surname'));
        if(empty($surname)){
            $surname = $io->ask('New user\'s surname');
        }

        $user = new Entity\User();
        $user->setIsActive(true);
        $user->setUsername($login);
        $user->setEmail($email);
        $user->setName($name);
        $user->setRole($role);
        $user->setSurname($surname);

        $encoder = $this->getContainer()->get('security.encoder_factory')->getEncoder($user);
        $password = $encoder->encodePassword($password, $user->getSalt());
        $user->setPassword($password);

        $manager = $this->getContainer()->get('doctrine')->getManager();
        $manager->persist($user);
        $manager->flush();

        $output->writeln('User has been created.');
    }
}
