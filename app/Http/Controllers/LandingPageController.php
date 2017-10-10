<?php
/**
 * Created by PhpStorm.
 * User: Chris
 * Date: 10/10/2017
 * Time: 7:50 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController
{
    //My shorthand for returning an generic object.
    //I find this easier than instantiating stdClass. This could be stored in a variety of data structures,
    //but in the interest of time, this is easiest.
    private $pageParams = [
    ];

    public function __construct()
    {
        $this->pageParams = [
            'default' =>
                (object)[
                    'brand' => 'Chris Ruskai',
                    'title' => 'Chris Ruskai Basic LP',
                    'links' => [
                        ['href' => '#about', 'label' => 'About'],
                        ['href' => '#services', 'label' => 'Services'],
                        ['href' => '#contact', 'label' => 'Contact'],
                    ],
                    'jumbotron' => (object)[
                        'title' => 'Basic LP',
                        'subtitle' => 'Parameters are driven by view object.',
                        'buttonText' => 'Call To Action',
                        'image' => 'img/lp/1900-500/city-stock.jpg',
                    ],
                    'featurettes' => [
                        (object)[
                            'title' => 'Blade Driven',
                            'subtitle' => 'For Maximum Customization',
                            'description' => 'This section is controlled an array within the view object. By making all of this information dynamic, it paves the way for creating landing pages by saving the content of a form submission into the DB.',
                            'image' => 'img/lp/500-500/1.jpg'
                        ],
                        (object)[
                            'title' => 'Automatically Alternates Sides',
                            'subtitle' => 'To place the features first.',
                            'description' => 'The blade automatically knows when to place things on the left or right. This frees you up for what matters: the content.',
                            'image' => 'img/lp/500-500/1.jpg',
                        ],
                    ],
                    'footer' => 'Copyright <i class="fa fa-copyright"></i> Chris Ruskai 2017'
                ],
            'secondary' =>
                (object)[
                    'brand' => 'Chris Ruskai',
                    'title' => 'Chris Ruskai Basic LP2',
                    'links' => [
                        ['href' => '#i_want_to', 'label' => 'I Want To...'],
                        ['href' => '#benefits', 'label' => 'Benefits'],
                        ['href' => '#news', 'label' => 'News'],
                        ['href' => '#social', 'label' => 'Get Social'],
                        ['href' => '#about', 'label' => 'About'],
                        ['href' => '#contact', 'label' => 'Contact'],
                    ],
                    'jumbotron' => (object)[
                        'title' => 'Secondary LP',
                        'subtitle' => 'Notice new images, content, and nav',
                        'buttonText' => 'Get Started',
                        'image' => 'img/lp/1900-500/lake-stock.jpg',
                    ],
                    'featurettes' => [
                        (object)[
                            'title' => 'Different Features',
                            'subtitle' => 'Make customization a breeze',
                            'description' => 'This section is controlled an array within the view object. By making all of this information dynamic, it paves the way for creating landing pages by saving the content of a form submission into the DB.',
                            'image' => 'img/lp/500-500/3.jpg'
                        ],
                        (object)[
                            'title' => 'Show Off Your Features',
                            'subtitle' => 'As many as you want',
                            'description' => 'The template is independent of the data that is being fed in.',
                            'image' => 'img/lp/500-500/4.jpg',
                        ],
                        (object)[
                            'title' => 'Demo Feature 3',
                            'subtitle' => 'Have as many or as few features as you want.',
                            'description' => 'The template is independent of the data that is being fed in.',
                            'image' => 'img/lp/500-500/2.jpg',
                        ],
                    ],
                    'footer' => 'Copyright <i class="fa fa-copyright"></i> Chris Ruskai 2017'
                ],
        ];
    }

    public function get_ViewLandingPage(Request $request)
    {
        $profile = $request->input('profile', 'default');
        return view('layouts.landing-page', ['viewObj' => $this->getLandingPageInfo($profile)]);
    }

    /*
     * Returns the specified page profile. If it doesn't exist, default to the profile "default".
     */
    protected function getLandingPageInfo($profile = 'default')
    {
        //dd($this->pageParams, $profile, $this->pageParams[$profile]);
        foreach($this->pageParams as $key => $val){
            if($key === $profile){
                return $this->pageParams[$profile];
            }
        }
        return $this->pageParams['default'];
    }

}