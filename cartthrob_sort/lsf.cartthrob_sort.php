<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Filter by ct_popularity="asc|desc"
 *
 * @package        low_search
 * @author         Jason Boothman - Reusser Design
 * @link           https://github.com/reusserdesign/Cartthrob-Popularity-Filter-for-Low-Search
 * @copyright      Copyright (c) 2019, Reusser Design
 */
class Low_search_filter_cartthrob_sort extends Low_search_filter {

	protected $params;
    protected $fields;
    private $_results;
    private $_filter_has_ran = false;

	public function filter($entry_ids)
	{
        $this->_results = array();

        $params = $this->params;
        $sort_order = $this->params->get('ct_popularity', 'empty');

        if ($sort_order == 'empty')
        {
            return $entry_ids;
        }

        ee()->db
            ->select('c.entry_id, SUM(r.quantity)')
            ->from('exp_channel_titles c')
            ->join('exp_cartthrob_order_items r', 'r.entry_id = c.entry_id', 'left')
            ->group_by('c.entry_id')
            ->order_by('SUM(r.quantity)', $sort_order);

        if ($entry_ids)
        {
            ee()->db->where_in('c.entry_id', $entry_ids);
        }

        $this->_filter_has_ran = true;

        $query = ee()->db->get();
        $this->_results = low_flatten_results($query->result_array(), 'entry_id');

        return $this->_results;
	}

	public function fixed_order()
	{
        return $this->_filter_has_ran;
	}

	public function exclude()
	{
		return NULL;
	}

	public function results($rows)
	{
		return $rows;
	}

}
// End of file lsf.cartthrob_sort.php
