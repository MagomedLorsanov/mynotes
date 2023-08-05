<?php

namespace App\Utils;

class Utils
{
    public function drawPager($totalItems, $perPage)
    {
        $firstA = '';
        $lastA = '';
        $pages = ceil($totalItems / $perPage);
        if (!isset($_GET['page']) || (int)($_GET['page']) <= 1) {
            $firstA = 'active';
            $page = 1;
        } else if ((int)($_GET['page']) > $totalItems) {
            $page = $pages;
        } else {
            $page = (int)$_GET['page'];
        }

        $pager =  "<nav aria-label='Page navigation'>";
        $pager .= "<ul class='pagination-list'>";
        $pager .= "<li><a class = '" . $firstA . "' href='/note?page=1' aria-label='Previous'><span aria-hidden='true'>«</span> Previous</a></li>";

        for ($i = 2; $i <= $pages - 1; $i++) {
            $active = $page == $i ? 'active' : '';
            $pager .= "<li><a class = 'page-num " . $active . "' href='/note?page=" . $i . "'>" . $i . "</a></li>";
        }
        $lastA = ($pages == (int)$_GET['page']) ? 'active' : '';
        $pager .= "<li><a class = '" . $lastA . "' href='/note?page=" . $pages . "' aria-label='Next'>Next <span aria-hidden='true'>»</span></a></li>";
        $pager .= "</ul>";

        return $pager;
    }
}
