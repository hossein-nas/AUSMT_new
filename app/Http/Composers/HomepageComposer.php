<?php
/**
 * Created by PhpStorm.
 * User: hosseinnasiri
 * Date: 12/4/2017 AD
 * Time: 07:58
 */

namespace App\Http\Composers;

use App\Models\Records\Record;
use Carbon\Carbon;
use Illuminate\View\View;

class HomepageComposer
{
    public function latestNews(View $view){
        $view->with('latestNews', Record::latestNews()->get() );
    }
    public function hotNews(View $view){
        $view->with('hotNews', Record::hotNews()->get() );
    }
    public function navbarItems(View $view){
        $it = (new \App\Http\Controllers\Navigationbar)->getOrderedNavItems();
        $view->with('Navbar', $it );
    }
    public function fastmenuItems(View $view){
        $it = (new \App\Http\Controllers\Fastmenu)->getAllFastmenuItem();
        $view->with('Fastmenu', $it);
    }

    public function allActiveSliderItems(View $view){
        $it = \App\Models\Slider::all();
        $view->with('Slider', $it);
    }
}
