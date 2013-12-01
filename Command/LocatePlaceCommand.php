<?php

namespace MSB\LocatorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LocatePlaceCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('msb:locate-place')
            ->addArgument('query', InputArgument::REQUIRED, 'What to search');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('Looking for <comment>%s</comment>', $input->getArgument('query')));

        $placeLocator = $this->getContainer()->get('place_locator');

        $results = $placeLocator->searchByKeyword($input->getArgument('query'));

        $output->writeln(sprintf('Found <info>%d</info> result(s)', count($results)));
        foreach ($results as $result) {
            $output->writeln(sprintf('<info>%s</info> by <comment>%s</comment>', $result['name'], $result['source']));
            $output->writeln(sprintf('  %s', $result['address']));
        }

        return 0;
    }
}
