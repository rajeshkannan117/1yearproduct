<?php
/**
 * Format class
 *
 * Helps to genereate form based on its type.
 *
 * @author  	RajeshKannan.C
 */
class Filter {

	public function filter_general(){
		$field['equal'] ='equal to';
		$field['not-equal'] ='not-equal to';
		$field['like'] ='like';
		$field['not-like'] ='not like';
		return $field;
	}
	public function filter_advanced(){
		$field['equal'] ='equal to';
		$field['not-equal'] ='not equal to';
		$field['greater-than'] ='greater than';
		$field['less-than'] ='less than';
		$field['greater-than-equal'] ='greater than or equal to';
		$field['less-than-equal'] ='less than or equal to';
		/*$field['blank'] ='is blank';
		$field['not-blank'] ='is not blank';
		$field['between'] ='is between';*/
		return $field;
	}
	public function query_filter($filter){
		$field['equal'] =' =';
		$field['not-equal'] =' <>';
		$field['greater-than'] =' >';
		$field['less-than'] =' <';
		$field['greater-than-equal'] =' >=';
		$field['less-than-equal'] =' <=';
		$field['like'] = 'LiKE ';
		$field['not-like'] = ' NOT LIKE ';
		/*$field['blank'] ='is blank';
		$field['not-blank'] ='is not blank';
		$field['between'] ='is between';*/
		return $field[$filter];
	}
	
}
