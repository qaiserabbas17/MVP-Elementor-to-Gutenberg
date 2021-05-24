<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\DomCrawler\Crawler;

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

Route::get(
	'/',
	function () {
		return view( 'home' );
	}
);

Route::match(
	array( 'get', 'post' ),
	'/post',
	function () {
		if ( request( 'url' ) ) {
			$html = file_get_html( request( 'url' ) );
			if ( count( $html->find( 'section > .elementor-container' ) ) < 1 ) {
				return back()->withErrors( array( 'notfound' => 'This page link is not in elementor.' ) );
			}
			foreach ( $html->find( 'link' ) as $link ) {
				if ( isset( $link->attr['href'] ) && preg_match( '/uploads\/elementor/m', $link->attr['href'] ) ) {
					echo "<link href='{$link->attr['href']}' />";
				}
			}
			// die;
			// dd($html);
			foreach ( $html->find( 'section > .elementor-container' ) as $s_k => $element ) {

				abc( 'Section', $s_k, $element );
				$rows = $element->find( '.elementor-row' );
				foreach ( $rows as $r_k => $row ) {
					echo '<ol><li>';
					abc( 'Row', $r_k, $row );
					$columns = $row->find( '.elementor-column' );
					foreach ( $columns as $c_k => $column ) {
						echo '<ol><li>';
						abc( 'Column', $c_k, $column );
						echo '</li></ol>';
						// var_dump( $column->attr, explode( ' ', $column->class ), $column->innertext );
					}
					echo '</li></ol>';
				}
			}
			die;
			// $crawler  = new Crawler( file_get_contents( request( 'url' ) ) );
			// $sections = $crawler->filter( 'body > section' )->each(
			// function ( $d ) {
			// var_dump( $d );
			// die;
			// }
			// );
			// foreach ( $sections as $s ) {
			// var_dump( $s->nodeName );
			// }
			// // var_dump($sections);
			// die;
		}
		return response( array( 'success' => false ) );
	}
)->name( 'postme' );

function abc( $tag = 'Section', $k, $element ) {
	$k += 1;
	echo "<h1>$tag #$k</h1><hr/>" . PHP_EOL;
	echo '<ul>';
	foreach ( $element->attr as $s_attr ) {
		echo '<li>' . var_export( $s_attr, true ) . '</li>';
	}
	// echo '<li>' . $element->innertext . '</li>';
	echo '</ul>';
}
