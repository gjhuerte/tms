<?php

/*
|--------------------------------------------------------------------------
| Ticket Routes
|--------------------------------------------------------------------------
|
| Here is where you can register ticket routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function() {
    Route::namespace('ticket')->group(function() {
        Route::prefix('ticket')->group(function () {
            Route::get('{id}/resolve', [
                'as' => 'ticket.resolve.form',
                'uses' => 'ResolveTicketController@create',
            ]);

            Route::post('{id}/resolve', [
                'as' => 'ticket.resolve',
                'uses' => 'ResolveTicketController@store',
            ]);
    
            Route::get('{id}/close', [
                'as' => 'ticket.close.form',
                'uses' => 'CloseTicketController@create',
            ]);

            Route::post('{id}/close', [
                'as' => 'ticket.close',
                'uses' => 'CloseTicketController@store',
            ]);
    
            Route::get('{id}/verify', [
                'as' => 'ticket.verify.form',
                'uses' => 'VerificationController@create',
            ]);

            Route::post('{id}/verify', [
                'as' => 'ticket.verify',
                'uses' => 'VerificationController@store',
            ]);
    
            Route::get('{id}/reopen', [
                'as' => 'ticket.reopen.form',
                'uses' => 'ReopenTicketController@create',
            ]);

            Route::post('ticket/{id}/reopen', [
                'as' => 'ticket.reopen',
                'uses' => 'ReopenTicketController@store',
            ]);
    
            Route::get('{id}/transfer', [
                'as' => 'ticket.transfer.form',
                'uses' => 'TransferTicketController@create',
            ]);

            Route::post('{id}/transfer', [
                'as' => 'ticket.transfer',
                'uses' => 'TransferTicketController@store',
            ]);
        });

        Route::resource('ticket', 'TicketController');
    });
});
