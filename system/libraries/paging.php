<?php
/**
 * paging for page paging
 * @package Ava
 * @since version 1.0
 * @author saturngod 
 * @category Library
 */
class Ava_paging
{
    /**
     * initialize the paging. $rp is a break
     * @param  $page
     * @param  int $rp
     * @param  int $total
     * @param  int $limit
     * @return array
     */
    function init($page,$total,$limit=10)
    {
        if($limit==0) $limit=1;
        
        $total_pages=ceil($total/$limit);

        $end=$page*$limit;
        $start=$end-$limit;

        if($end > $total) $end=$total;

        if($start==0) $start=1;
        else $start=$start+1;

        $prev=1;
        if($page > 1) $prev=$page-1;

        $next=$total_pages;

        if($page < $total_pages) $next =$page+1;

        $paging['current_page']=$page;
        $paging['total']=$total;
        $paging['limit']=$limit;

        $paging['total_pages']=$total_pages;
        $paging['start_point']=$start;
        $paging['end_point']=$end;

        $paging['next_page']=$next;
        $paging['prev_page']=$prev;
        
        return $paging;
    }
}
?>