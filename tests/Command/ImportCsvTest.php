<? php

namespace App\Command;

use App\Entity\Item;
use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportCsv extends Command
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
            ->setDescription('Imports data from CSV file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Trying to load the feed...');

        $this->importCsv(__DIR__ . '/../public/data/Room.csv', Room::class, [
            'setName',
            'setDescription',
            'setImage',
            'setNorth',
            'setSouth',
            'setEast',
            'setWest',
            'setInspect'
        ]);

        $this->importCsv(__DIR__ . '/../public/data/Item.csv', Item::class, [
            'setName',
            'setDescription',
            'setImage',
            'setRoom'
        ]);

        $this->emi->flush();

        $io->success('Import successful!');
        return Command::SUCCESS;
    }

    private function importCsv(string $filePath, string $entityClass, array $fields): void
    {
        if (($handle = fopen($filePath, 'r')) !== false) {
            $header = fgetcsv($handle); // Skip the header may be

            while (($row = fgetcsv($handle)) !== false) {
                $entity = new $entityClass();
                foreach ($fields as $index => $setter) {
                    if (isset($row[$index]) && method_exists($entity, $setter)) {
                        $entity->$setter($row[$index]);
                    }
                }
                $this->emi->persist($entity);
            }
            fclose($handle);
        }
    }
}
