<?php

namespace Nameday\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Illuminate\Database\Capsule\Manager as DB;
use Nameday\Model\NameDay;

class Import extends Command {

	protected function configure() {
		$this
			->setName('Import')
			->setDescription('Import namedays from file')
			->addArgument(
				'filename',
				InputArgument::REQUIRED,
				'Fájl neve'
			)
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$filename = $input->getArgument('filename');

		if (!file_exists($filename)) {
			throw new Exception("File does not exist " . $filename);
		}

		echo "Loading file" . $filename . PHP_EOL;
		$fileRows = explode("\n", file_get_contents($filename));

		$data = [];
		foreach ($fileRows as $row) {
			if (preg_match('/^([\w]+)[\s]+([0-9,\.\*]+)$/mu', trim($row), $matches)) {
				$dates = explode(',', $matches[2]);
				foreach ($dates as $date) {
					$dateParts = explode(".", $date);
					$data[] = array(
						"month" => intval($dateParts[0]),
						"day" => intval($dateParts[1]),
						"name" => $matches[1],
						"primary" => intval($dateParts[2]) === "*"
					);
				}
				
			}
		}
		echo "Found " . count($data) . " entries. Inserting..." . PHP_EOL;

		DB::beginTransaction();

		DB::table('namedays')->delete();

		foreach ($data as $key => $value) {
			$model = new NameDay($value);
			$model->save();
		}

		DB::commit();

		echo "Done" . PHP_EOL;
	}

}