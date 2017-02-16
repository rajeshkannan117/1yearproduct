<?php
/**
 * Status class
 *
 * Helps to genereate form based on its type.
 *
 * @author  	RajeshKannan.C
 */
class Status {

	public function status_code($status_code){
		$status['0'] = 'uk-badge-primary';
		$status['1'] = 'uk-badge-primary';
		$status['2'] = 'uk-badge-warning';
		$status['3'] = 'uk-badge-success';
		return $status[$status_code];
	}

}
