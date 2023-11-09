<?php

namespace App\Console\Commands;

use App\Repositories\ArticleRepository;
use App\Services\ArticleDataProvider\ArticleDataProviderContext;
use App\Services\ArticleDataProvider\NewYorkTimesDataProvider;
use Illuminate\Console\Command;

class NewYorkTimesFetchDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:data:newyorktimes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data using New York Times API';

    protected ArticleDataProviderContext $dataProviderContext;

    public function __construct(ArticleDataProviderContext $dataProviderContext)
    {
        parent::__construct();

        $this->dataProviderContext = $dataProviderContext;
        $this->dataProviderContext->setProvider(new NewYorkTimesDataProvider(new ArticleRepository()));
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // get data from New York Times
        $this->dataProviderContext->fetchData();
    }
}
