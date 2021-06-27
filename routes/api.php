<?php

use App\Http\Requests\GameSessionRequest;
use App\Models\GameSession;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')
     ->name('api.game-session.')
     ->prefix('game-session')
     ->group(function () {
         Route::name('index')
              ->get('/', function () {
                  return GameSession::all();
              });
         Route::name('get')
              ->get('/{game_session}', function (GameSession $game_session) {
                  return $game_session;
              });
         Route::name('post')
              ->post('/', function (GameSessionRequest $request) {
                  $data = $request->validated();

                  $game_session = new GameSession([
                      'name'       => $data['name'],
                      'event_date' => $data['event_date'],
                  ]);
                  $game_session->save();

                  return response()->json($game_session, Response::HTTP_CREATED);
              });
         Route::name('put')
              ->put('/{game_session}', function (GameSession $gameSession, GameSessionRequest $request) {
                  $data = $request->validated();
                  if ($gameSession->update($data))
                  {
                      return $gameSession;
                  }
                  else
                  {
                      return response(Response::HTTP_BAD_REQUEST);
                  }
              });
     });
