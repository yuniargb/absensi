<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);
        View::composer('layout', function( $view )
        {
             $data  = DB::table('logos')->first();
             $waliKelas = null;
             if(!empty(auth()->user()->username))
                $waliKelas = DB::table('gurus')
                            ->select('kelas.*')
                            ->join('kelas', 'gurus.id', '=', 'kelas.guru_id')
                            ->where('gurus.nip',auth()->user()->username)
                            ->first();

            //pass the data to the view
            $view->with( 'data', $data );
            $view->with( 'walikelas', $waliKelas );
        } );

        Blade::directive('currency', function ( $expression ) { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });
    }
}
