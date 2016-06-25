<?php
//
//namespace App\Http\Middleware;
//
//use Closure;
//use Illuminate\Support\Facades\Auth;
//use Lavary\Menu;
//
//class Menu
//{
//    /**
//     * Menu collection
//     *
//     * @var Illuminate\Support\Collection
//     */
//    protected $collection;
//
//    /**
//     * Initializing the menu builder
//     */
//    public function __construct()
//    {
//        // creating a collection for storing menus
//        $this->collection = new Collection();
//    }
//
//    /**
//     * Create a new menu instance
//     *
//     * @param  string  $name
//     * @param  callable  $callback
//     * @return \Lavary\Menu\Menu
//     */
//    public function handle($request, Closure $next, $guard = null )
//    {
//        if (Auth::guard($guard)->check()){
//            Menu::make('MyNavBar', function($menu){
//
//                $menu->add('Projets', 'projects');
//                $menu->add('Projet', 'project');
//                $menu->add('Edition', 'edit');
//
//            });
//        }
//        return $next($request);
//
//
//    }
//}