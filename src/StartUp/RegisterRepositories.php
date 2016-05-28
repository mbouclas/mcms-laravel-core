<?php

namespace IdeaSeven\Core\StartUp;

use IdeaSeven\Core\Services\Lang\Contracts\LanguagesContract;
use IdeaSeven\Core\Services\Lang\Repositories\DbLanguagesRepository;
use Illuminate\Support\ServiceProvider;
use App;

class RegisterRepositories
{
    public function handle(ServiceProvider $serviceProvider)
    {
        // LanguagesContract interface,  DbLanguagesRepository class
        App::bind(LanguagesContract::class, DbLanguagesRepository::class);
    }
}