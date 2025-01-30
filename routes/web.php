<?php

use App\Http\Controllers\MailController;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes APPS
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/ 
$router->get('/', function () use ($router) {
    return view('layouts.login', ["title" => "Login"]);
});

$router->get('/login', function () use ($router) {
    // return $router->app->version();
    return view('layouts.login', ["title" => "Login"]);
});

$router->get('/reset_password', function () use ($router) {
    return view('layouts.reset_password', ["title" => "Reset Password"]);
});


$router->group(['prefix' => 'dashboard'], function () use ($router) {
    $router->get('/', function () use ($router) {
        // return view('modules.dashboard', ["title" => "Dashboard"]);
        return view('modules.users', ["title" => "Users"]);
    });
});

$router->group(['prefix' => 'roles'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return view('modules.roles', ["title" => "Roles"]);
    });
});

$router->group(['prefix' => 'users'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return view('modules.users', ["title" => "Users"]);
    });
});

$router->group(['prefix' => 'ads'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return view('modules.ads', ["title" => "Advertisment"]);
    });
});

$router->group(['prefix' => 'ebrosure'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return view('modules.ebrosure', ["title" => "eBrosure"]);
    });
});

$router->group(['prefix' => 'type_of_interest'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return view('modules.type_of_interest', ["title" => "Type of Interest"]);
    });
});

$router->group(['prefix' => 'category_type_of_interest'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return view('modules.category_type_of_interest', ["title" => "Category Type of Interest"]);
    });
});

$router->group(['prefix' => 'destination'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return view('modules.destination', ["title" => "Destination"]);
    });
});

$router->group(['prefix' => 'event'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return view('modules.event', ["title" => "Event"]);
    });
});

$router->group(['prefix' => 'rating'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return view('modules.rating', ["title" => "Rating"]);
    });
});

$router->group(['prefix' => 'reviews'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return view('modules.reviews', ["title" => "Reviews"]);
    });
});

$router->group(['prefix' => 'history'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return view('modules.history', ["title" => "History"]);
    });
});

$router->group(['prefix' => 'term_and_conditions'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return view('modules.term_and_conditions', ["title" => "Term & Conditions"]);
    });
});



/*
|--------------------------------------------------------------------------
| Application Routes API
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});

$router->get('send_email' ,'MailController@mail');

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return response()->json([
                "status"=> true,
                "message"=> 'Welcome to SIPAYU Services! Ok!',
                "data"=> []
            ], 200);
    });

    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->post('reset-password', 'AuthController@resetPassword');
    $router->get('forgot', 'AuthController@forgot');
    $router->get('me', 'AuthController@me');

    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('list', 'AuthController@list');
        $router->get('/{id}', 'AuthController@show');
        $router->post('/create', 'AuthController@store');
        $router->post('/update/{id}', 'AuthController@update');
        $router->delete('/delete/{id}', 'AuthController@destroy');
    });

    $router->group(['prefix' => 'roles'], function () use ($router) {
        $router->get('', 'RoleController@index');
        $router->get('/{id}', 'RoleController@show');
        $router->post('/create', 'RoleController@store');
        $router->post('/update/{id}', 'RoleController@update');
        $router->delete('/delete/{id}', 'RoleController@destroy');
    });

    $router->group(['prefix' => 'ads'], function () use ($router) {
        $router->get('', 'AdvertismentController@index');
        $router->get('/list_dt', 'AdvertismentController@list_dt');
        $router->get('/{id}', 'AdvertismentController@show');
        $router->post('/create', 'AdvertismentController@store');
        $router->post('/update/{id}', 'AdvertismentController@update');
        $router->delete('/delete/{id}', 'AdvertismentController@destroy');
    });

    $router->group(['prefix' => 'ebrosure'], function () use ($router) {
        $router->get('', 'EbrosureController@index');
        $router->get('/list_dt', 'EbrosureController@list_dt');
        $router->get('/{id}', 'EbrosureController@show');
        $router->post('/create', 'EbrosureController@store');
        $router->post('/update/{id}', 'EbrosureController@update');
        $router->delete('/delete/{id}', 'EbrosureController@destroy');
    });

    $router->group(['prefix' => 'type_of_interest'], function () use ($router) {
        $router->get('', 'TypeOfInterestController@index');
        $router->get('/list', 'TypeOfInterestController@list');
        $router->get('/category_list', 'TypeOfInterestController@category_list');
        $router->get('/list_dt', 'TypeOfInterestController@list_dt');
        $router->get('/category_list_dt', 'TypeOfInterestController@category_list_dt');
        $router->get('/{id}', 'TypeOfInterestController@show');
        $router->post('/create', 'TypeOfInterestController@store');
        $router->post('/update/{id}', 'TypeOfInterestController@update');
        $router->delete('/delete/{id}', 'TypeOfInterestController@destroy');
    });

    $router->group(['prefix' => 'destination'], function () use ($router) {
        $router->get('/list_dt', 'DestinationController@list_dt');
        $router->get('/list', 'DestinationController@list');
        $router->get('/{id}', 'DestinationController@show');
        $router->post('/create', 'DestinationController@store');
        $router->post('/update/{id}', 'DestinationController@update');
        $router->delete('/delete/{id}', 'DestinationController@destroy');
    });

    $router->group(['prefix' => 'event'], function () use ($router) {
        $router->get('', 'EventController@index');
        $router->get('/list_dt', 'EventController@list_dt');
        $router->get('/{id}', 'EventController@show');
        $router->post('/create', 'EventController@store');
        $router->post('/update/{id}', 'EventController@update');
        $router->delete('/delete/{id}', 'EventController@destroy');
    });

    $router->group(['prefix' => 'rating'], function () use ($router) {
        $router->get('', 'RatingController@index');
        $router->get('/{id}', 'RatingController@show');
        $router->post('/create', 'RatingController@store');
        $router->post('/update/{id}', 'RatingController@update');
        $router->delete('/delete/{id}', 'RatingController@destroy');
    });

    $router->group(['prefix' => 'review'], function () use ($router) {
        $router->get('', 'ReviewController@index');
        $router->get('/list', 'ReviewController@list');
        $router->get('/list_dt', 'ReviewController@list_dt');
        $router->get('/{id}', 'ReviewController@show');
        $router->post('/create', 'ReviewController@store');
        $router->post('/update/{id}', 'ReviewController@update');
        $router->delete('/delete/{id}', 'ReviewController@destroy');
    });

    $router->group(['prefix' => 'history'], function () use ($router) {
        $router->get('', 'HistoryController@index');
        $router->get('/{id}', 'HistoryController@show');
        $router->post('/create', 'HistoryController@store');
        $router->post('/update/{id}', 'HistoryController@update');
        $router->delete('/delete/{id}', 'HistoryController@destroy');
    });

    $router->group(['prefix' => 'term_and_condition'], function () use ($router) {
        $router->get('', 'TermAndConditionController@index');
        $router->get('/list', 'TermAndConditionController@list');
        $router->get('/{id}', 'TermAndConditionController@show');
        $router->post('/create', 'TermAndConditionController@store');
        $router->post('/update/{id}', 'TermAndConditionController@update');
        $router->delete('/delete/{id}', 'TermAndConditionController@destroy');
    });

});