<?php

namespace App\Command;

use App\Entity\Item;
use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportCsvCommand extends Command
{
    protected EntityManagerInterface $emi;

    public function __construct(EntityManagerInterface $emi)
    {
        parent::__construct();

        $this->emi = $emi;
    }
    protected function configure(): void
    {
        $this
            ->setName('csv:import')
            ->setDescription('Imports data from CSV file')
        ;
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ):int {
        $iObj = new SymfonyStyle($input, $output);

        $iObj->setTitle('Trying to load the feed...');

        $roomCSV = '%kernel.root_dir%/../public/data/Room.csv';
        if (($handle = fopen($roomCSV, 'r')) !== false) {
            $header = fgetcsv($handle);

            while (($row = fgetcsv($handle)) !== false) {
                $room = new Room();

                if ($row[0]) {
                    $room->setName($row[0]);
                }

                if ($row[1]) {
                    $room->setDescription($row[1]);
                }

                if ($row[2]) {
                    $room->setImage($row[2]);
                }

                if ($row[3]) {
                    $room->setNorth($row[3]);
                }

                if ($row[4]) {
                    $room->setSouth($row[4]);
                }

                if ($row[5]) {
                    $room->setEast($row[5]);
                }

                if ($row[6]) {
                    $room->setWest($row[6]);
                }

                if ($row[7]) {
                    $room->setInspect($row[7]);
                }

                $this->emi->persist($room);
            }

            fclose($handle);
        }

        $itemCSV = '%kernel.root_dir%/../public/data/Item.csv';
        if (($handle = fopen($itemCSV, 'r')) !== false) {
            $header = fgetcsv($handle);

            while (($row = fgetcsv($handle)) !== false) {
                $room = new Item();

                if ($row[0]) {
                    $room->setName($row[0]);
                }

                if ($row[1]) {
                    $room->setDescription($row[1]);
                }

                if ($row[2]) {
                    $room->setImage($row[2]);
                }

                if ($row[3]) {
                    $room->setRoom($row[3]);
                }

                $this->emi->persist($room);
            }

            fclose($handle);
        }

        $this->emi->flush();

        $iObj->success('successful!');
        return Command::SUCCESS;
    }
}
