<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ServiceCommand extends ContainerAwareCommand {
    protected function configure()     {
        $this
            ->setName('service:get:methods')
            ->setDescription('Get all methods available for a provided service id')
	          ->addArgument('service-id', InputArgument::REQUIRED, 'Enter a service id')
       ;
    }
    protected function execute(InputInterface $input, OutputInterface $output){
	      if(!$this->getContainer()->has($input->getArgument('service-id'))){
            throw new \Exception('The service id you\'ve provided does not exist! You may want to use debug:container console command to get a valid service id.');
        }
        $service = $this->getContainer()->get($input->getArgument('service-id'));
        $serviceClass = get_class($service);
	      $methods = get_class_methods($serviceClass);

        $output->writeln(print_r($methods));
    }
}
