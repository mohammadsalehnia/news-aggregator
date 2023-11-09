<?php

namespace App\Console\Commands;

use App\Repositories\ArticleRepository;
use App\Services\ArticleDataProvider\ArticleDataProviderContext;
use App\Services\ArticleDataProvider\NewsAPIDataProvider;
use Illuminate\Console\Command;

class NewsAPIFetchDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:data:newsapi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data using NewsAPI';

    protected ArticleDataProviderContext $dataProviderContext;

    public function __construct(ArticleDataProviderContext $dataProviderContext)
    {
        parent::__construct();

        $this->dataProviderContext = $dataProviderContext;
        $this->dataProviderContext->setProvider(new NewsAPIDataProvider(new ArticleRepository()));
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // get data from NewsAPI
        $this->dataProviderContext->fetchData();
    }
}
