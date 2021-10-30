<?php

namespace App\Providers;

use App\Interfaces\AdminRepositoryInterface;
use App\Interfaces\CardRepositoryInterface;
use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\FavoriteRepositoryInterface;
use App\Interfaces\PageRepositoryInterface;
use App\Interfaces\SpecialistRepositoryInterface;
use App\Interfaces\PlaceRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\ScheduleRepositoryInterface;
use App\Interfaces\SpecialtyCategoryRepositoryInterface;
use App\Interfaces\SpecialtyRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use App\Interfaces\VariableRepositoryInterface;
use App\Models\Admin;
use App\Models\Card;
use App\Models\Customer;
use App\Models\Favorite;
use App\Models\Page;
use App\Models\Specialist;
use App\Models\Place;
use App\Models\Post;
use App\Models\Schedule;
use App\Models\Specialty;
use App\Models\SpecialtyCategory;
use App\Models\Transaction;
use App\Models\Variable;
use App\Repositories\AdminRepository;
use App\Repositories\CardRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\FavoriteRepository;
use App\Repositories\PageRepository;
use App\Repositories\SpecialistRepository;
use App\Repositories\PlaceRepository;
use App\Repositories\PostRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\SpecialtyCategoryRepository;
use App\Repositories\SpecialtyRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\VariableRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdminRepositoryInterface::class, function ($app) {
            return new AdminRepository(new Admin());
        });
        $this->app->bind(PostRepositoryInterface::class, function ($app) {
            return new PostRepository(new Post());
        });
        $this->app->bind(SpecialtyRepositoryInterface::class, function ($app) {
            return new SpecialtyRepository(new Specialty());
        });
        $this->app->bind(SpecialtyCategoryRepositoryInterface::class, function ($app) {
            return new SpecialtyCategoryRepository(new SpecialtyCategory());
        });
        $this->app->bind(PageRepositoryInterface::class, function ($app) {
            return new PageRepository(new Page());
        });
        $this->app->bind(SpecialistRepositoryInterface::class, function ($app) {
            return new SpecialistRepository(new Specialist());
        });
        $this->app->bind(PlaceRepositoryInterface::class, function ($app) {
            return new PlaceRepository(new Place());
        });
        $this->app->bind(ScheduleRepositoryInterface::class, function ($app) {
            return new ScheduleRepository(new Schedule());
        });
        $this->app->bind(CustomerRepositoryInterface::class, function ($app) {
            return new CustomerRepository(new Customer());
        });
        $this->app->bind(FavoriteRepositoryInterface::class, function ($app) {
            return new FavoriteRepository(new Favorite());
        });
        $this->app->bind(VariableRepositoryInterface::class, function ($app) {
            return new VariableRepository(new Variable());
        });
        $this->app->bind(CardRepositoryInterface::class, function ($app) {
            return new CardRepository(new Card());
        });
        $this->app->bind(TransactionRepositoryInterface::class, function ($app) {
            return new TransactionRepository(new Transaction());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
