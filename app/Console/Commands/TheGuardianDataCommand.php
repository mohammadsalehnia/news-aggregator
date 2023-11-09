<?php

namespace App\Console\Commands;

use App\Repositories\ArticleRepository;
use App\Services\ArticleDataProvider\ArticleDataProviderContext;
use App\Services\ArticleDataProvider\TheGuardianDataProvider;
use Illuminate\Console\Command;

class TheGuardianDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:data:theguardian';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data using The Guardian API';

    protected ArticleDataProviderContext $dataProviderContext;

    public function __construct(ArticleDataProviderContext $dataProviderContext)
    {
        parent::__construct();

        $this->dataProviderContext = $dataProviderContext;
        $this->dataProviderContext->setProvider(new TheGuardianDataProvider(new ArticleRepository()));
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // get data from The Guardian
        $this->dataProviderContext->fetchData();
    }
}
