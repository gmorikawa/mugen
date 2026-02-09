<?php

namespace App\Application\Providers;

use App\Core\Auth\Interfaces\TokenRepository;
use App\Core\ColorEncoding\Interfaces\ColorEncodingRepository;
use App\Core\Company\Interfaces\CompanyRepository;
use App\Core\Category\Interfaces\CategoryRepository;
use App\Core\Country\Interfaces\CountryRepository;
use App\Core\File\Interfaces\FileRepository;
use App\Core\Language\Interfaces\LanguageRepository;
use App\Core\Platform\Interfaces\PlatformRepository;
use App\Core\User\Interfaces\UserRepository;
use App\Infrastructure\Persistence\Repositories\EloquentColorEncodingRepository;
use App\Infrastructure\Persistence\Repositories\EloquentCompanyRepository;
use App\Infrastructure\Persistence\Repositories\EloquentCategoryRepository;
use App\Infrastructure\Persistence\Repositories\EloquentCountryRepository;
use App\Infrastructure\Persistence\Repositories\EloquentFileRepository;
use App\Infrastructure\Persistence\Repositories\EloquentLanguageRepository;
use App\Infrastructure\Persistence\Repositories\EloquentPlatformRepository;
use App\Infrastructure\Persistence\Repositories\EloquentTokenRepository;
use App\Infrastructure\Persistence\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(FileRepository::class, EloquentFileRepository::class);
        $this->app->bind(TokenRepository::class, EloquentTokenRepository::class);
        $this->app->bind(LanguageRepository::class, EloquentLanguageRepository::class);
        $this->app->bind(CountryRepository::class, EloquentCountryRepository::class);
        $this->app->bind(CategoryRepository::class, EloquentCategoryRepository::class);
        $this->app->bind(ColorEncodingRepository::class, EloquentColorEncodingRepository::class);
        $this->app->bind(CompanyRepository::class, EloquentCompanyRepository::class);
        $this->app->bind(PlatformRepository::class, EloquentPlatformRepository::class);
    }

    public function boot(): void {}
}
