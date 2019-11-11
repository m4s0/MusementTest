<?php

namespace App\Command;

use App\Service\BuildSiteMap;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class BuildSiteMapCommand extends Command
{
    protected static $defaultName = 'app:build-sitemap';
    /**
     * @var BuildSiteMap
     */
    private $buildSitemap;

    public function __construct(BuildSiteMap $buildSitemap)
    {
        $this->buildSitemap = $buildSitemap;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Builds a SiteMap given a Local')
            ->addOption('locale', 'l', InputOption::VALUE_REQUIRED, 'Locale')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $locale = $input->getOption('locale');

        try {
            $sitemapXml = $this->buildSitemap->execute($locale, 20, 20);
        } catch (\Exception $e) {
            $io->error(sprintf('%s', $e->getMessage()));

            return 1;
        }

        $io->writeln($sitemapXml);

        return 0;
    }
}
