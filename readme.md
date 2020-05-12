# Laravel - IPBoard API

Begin by installing this package through Composer. Run the following from the terminal:  
` composer require mbozwood/laravel-ipboardapi `  

To expose the neccessary configuration, run  
` php artisan vendor:publish --tag=config --provider=MBozwood\IPBoardApi\IpboardApiLaravelServiceProvider`

Add the following properties to your .env file
 - `IPBOARD_API_URL`
 - `IPBOARD_API_KEY`  
 
To use the package, add `LaravelIPB` to a constructor. This package can be used both statically or non-statically.


```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MBozwood\IPBoardApi\LaravelIPB;

class UpdateNews extends Command
{
    protected $laravelIpb;
    
    public function __construct(LaravelIPB $laravelIpb)
    {
        $this->laravelIpb = $laravelIpb;
        parent::__construct();
    }

    public function handle()
    {
        $request = [
            'forums' => 24,
            'sortBy' => 'date',
            'sortDir' => 'desc'
        ];
        $announcements = $this->laravelIpb->getTopics($request);
        ...
    }
}
```

