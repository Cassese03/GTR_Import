<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('', array('uses' => 'HomeController@index'));
Route::any('/login/{token}', array('uses' => 'HomeController@login'));
Route::any('admin/logout', array('uses' => 'AdminController@logout'));

Route::any('ajax/load_articoli/{filtro}/{categoria}/{marca}/{pagina}/{ord}', array('uses' => 'AjaxController@load_articoli'));
Route::any('ajax/load_pagine/{pagina}/{count}', array('uses' => 'AjaxController@load_pagine'));
Route::any('ajax/cambia_qta/{qta}/{id}', array('uses' => 'AjaxController@cambia_qta'));
Route::any('ajax/cambia_note/{id}', array('uses' => 'AjaxController@cambia_note'));
Route::any('ajax/check_cart', array('uses' => 'AjaxController@check_cart'));
Route::any('ajax/aggiungi_al_carrello/{cd_ar}/{quantita}/{pagina}/{sconto}/{prezzo}', array('uses' => 'AjaxController@aggiungi_al_carrello'));
Route::any('ajax/aggiungi_al_carrello_index/{cd_ar}/{quantita}/{sconto}/{prezzo}', array('uses' => 'AjaxController@aggiungi_al_carrello_index'));
Route::any('ajax/load_marche/{id_marca}', array('uses' => 'AjaxController@load_marche'));
Route::any('ajax/load_categoria/{categoria}', array('uses' => 'AjaxController@load_categoria'));
Route::any('ajax/load_seconda_categoria/{categoria}', array('uses' => 'AjaxController@load_seconda_categoria'));
Route::any('ajax/load_terza_categoria/{categoria}', array('uses' => 'AjaxController@load_terza_categoria'));
Route::any('ajax/load_richieste/{cd_cf}/{offset}', array('uses' => 'AjaxController@load_richieste'));
Route::any('ajax/load_richieste_storico/{offset}', array('uses' => 'AjaxController@load_richieste_storico'));
Route::any('ajax/load_righe/{id_dotes}', array('uses' => 'AjaxController@load_righe'));
Route::any('ajax/load_righe_fornitore/{id_dotes}', array('uses' => 'AjaxController@load_righe_fornitore'));
Route::any('ajax/load_righe_storico/{id_dotes}/{stato}', array('uses' => 'AjaxController@load_righe_storico'));

Route::any('cliente/index', array('uses' => 'ClienteController@index'));
Route::any('cliente/manutenzione', array('uses' => 'ClienteController@manutenzione'));
Route::any('cliente/storico', array('uses' => 'ClienteController@storico'));
Route::any('cliente/catalogo', array('uses' => 'ClienteController@catalogo'));
Route::any('cliente/dettaglio_storico/{id}', array('uses' => 'ClienteController@dettaglio_storico'));
Route::any('cliente/dettaglio_storico/{id}/stampa', array('uses' => 'ClienteController@dettaglio_storico_stampa'));
Route::any('cliente/contattaci', array('uses' => 'ClienteController@contattaci'));
Route::any('cliente/registrati', array('uses' => 'ClienteController@registrati'));
Route::any('cliente/registrati_cliente', array('uses' => 'ClienteController@registrati_cliente'));
Route::any('cliente/policy', array('uses' => 'ClienteController@policy'));
Route::any('cliente/reclami', array('uses' => 'ClienteController@reclami'));
Route::any('cliente/ftp', array('uses' => 'ClienteController@ftp'));
Route::any('cliente/csv_dedicato/{token}', array('uses' => 'ClienteController@csv_dedicato'));
Route::any('cliente/excel_dedicato/{token}', array('uses' => 'ClienteController@excel_dedicato'));
Route::any('cliente/nuovo_reclamo', array('uses' => 'ClienteController@nuovo_reclamo'));
Route::any('cliente/articoli', array('uses' => 'ClienteController@articoli'));
Route::any('cliente/carrello', array('uses' => 'ClienteController@carrello'));
Route::any('cliente/dettaglio/{articolo}', array('uses' => 'ClienteController@dettaglio'));
Route::any('cliente/logout', array('uses' => 'ClienteController@logout'));
Route::any('cliente/login', array('uses' => 'ClienteController@login'));


