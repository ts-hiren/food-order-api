<?php

class FrontModel extends CI_Model {
	function getData($table,$cond,$select = '*',$response = 'array',$join = [],$extraFilter = [])
	{
		$this->db->select($select);
		if (isset($cond['where_in'])) {
			$where_in = $cond['where_in'];
			$where_in_count = count($where_in);
			for ($i=0; $i < $where_in_count; $i++) { 
				foreach ( $where_in[$i] as $key => $value) {
					$this->db->where_in($key,$value);
				}
			}
			unset($cond['where_in']);
		}
		if (isset($cond['where_not_in'])) {
			$where_not_in = $cond['where_not_in'];
			$where_not_in_count = count($where_not_in);
			for ($i=0; $i < $where_not_in_count; $i++) { 
				foreach ( $where_not_in[$i] as $key => $value) {
					$this->db->where_not_in($key,$value);
				}
			}
			unset($cond['where_not_in']);
		}
		$this->db->where($cond);
		$this->db->from($table);
		if (count($join) > 0) {
			foreach($join as $j){
				if(@$j['type'] == ''){
					$this->db->join($j['table'],$j['on']);
				}
				else{
					$this->db->join($j['table'],$j['on'],$j['type']);
				}	
			}
		}
		if (isset($extraFilter['group_by'])) {
			$this->db->group_by($extraFilter['group_by']);
		}
		if (isset($extraFilter['order_by'])) {
			if (count($extraFilter['order_by']) == 2) {
				$this->db->order_by($extraFilter['order_by'][0],$extraFilter['order_by'][1]);
			}else{
				$this->db->order_by($extraFilter['order_by'][0]);
			}
			
		}
		if (isset($extraFilter['limit'])) {
			$this->db->limit($extraFilter['limit'][0],$extraFilter['limit'][1]);
		}
		$sql = $this->db->get();
		if ($response == 'array') {
			return $sql->result_array();
		}elseif ($response == 'row') {
			return $sql->row_array();
		}elseif ($response == 'count') {
			return $sql->num_rows();
		}else{
			return $sql->result();
		}
	}
	function insertData($table,$data)
	{
		return $this->db->insert($table,$data);
	}
	function updateData($table,$cond,$data)
	{
		$this->db->where($cond);
		return $this->db->update($table, $data);
	}
}
