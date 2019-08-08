<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function datatable($getarray)
{
	$queryArray['condition'] = [];
	$columns = $getarray['columns'];
	$queryArray['offset'] = $getarray['start'];
	$queryArray['limit'] = $getarray['length'];
	$queryArray['order_by'] = $columns[$getarray['order'][0]['column']]['name'];
	$queryArray['order_dir'] = $getarray['order'][0]['dir'];
	foreach ($columns as $column) {
		if ($column['search']['value'] != '') {
			$name = $column['name'];
			$queryArray['condition'][$name.' LIKE'] = '%'.$column['search']['value'].'%';
		}
	}
	return $queryArray;
}