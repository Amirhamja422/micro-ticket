<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
// Broadcast::channel('App.Models.User.{id}', function ($userId,$id) {
//     return (int) $userId === (int) $id;
// });

// Broadcast::channel('post.created', function ($userId) {
//    return $userId = Auth::user()->id = $userId;
// });

Broadcast::channel('Test', function () {
    return true;
});


// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

