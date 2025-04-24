<?php

// $per_page = 5; //элементов на странице
// $total = $db->query("SELECT count(*) FROM `posts`")->getColumn();
// $pages_count = ceil($total / $per_page); //всего страниц
// $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1; //запрос страницы

// if ($current_page < 1) {
//     $current_page = 1;
// } else if ($current_page > $pages_count) {
//     $current_page = $pages_count;
// }

// $start_elem = ($current_page - 1) * $per_page;


class Paginator
{

    public $page = 1; //с get
    public $per_page = 1; //элементов на странице
    public $total = 1; //всего элементов
    public $mid_size = 2; //соседи
    public $all_pages = 10; //когда показать все страницы
    public $current_page = 1;
    public $uri = '';
    public $pages_count = 1;

    public function __construct(
        $page = 1,
        $per_page = 1,
        $total = 1
    ) {
        $this->page = $page;
        $this->per_page = $per_page;
        $this->total = $total;

        $this->pages_count = $this->getCountPages();
        $this->current_page = $this->getCurrentPage();
        $this->uri = $this->getParams();
        $this->mid_size = $this->getMidSize();
    }

    protected function getCountPages()
    {
        return (int) ceil($this->total / $this->per_page);
    }

    protected function getCurrentPage()
    {
        if ($this->page < 1) {
            return 1;
        } else if ($this->page > $this->pages_count) {
            return $this->pages_count;
        } else {
            return $this->page;
        }
    }

    public function getStartId()
    {
        return ($this->current_page - 1) * $this->per_page;
    }

    protected function getParams()
    {
        $req_uri = $_SERVER['REQUEST_URI'];
        $req_uri = explode('?', $req_uri);
        $uri = $req_uri[0];
        if (isset($req_uri[1]) && $req_uri[1] != '') {
            $uri .= '?';
            $params_strings = explode('&', $req_uri[1]);
            foreach ($params_strings as $param) {
                if (!str_contains($param, 'page=')) {
                    $uri .= "{$param}&";
                }
            }
        }

        //dump($req_uri[1]);
        return $uri;
    }

    public function listPages()
    {
        //pagination buttons
        $start = "";
        $prev = "";
        $left_mid = "";
        $right_mid = "";
        $next = "";
        $end = "";



        if ($this->current_page > 1) {
            $prev = $this->createButtonArrow("next", $this->current_page - 1, "&lt;");
        }
        if ($this->current_page < $this->pages_count) {
            $next = $this->createButtonArrow("next", $this->current_page + 1, "&gt;");

        }
        if ($this->current_page > $this->mid_size + 1) {
            $start = $this->createButtonArrow("start", 1, "&laquo;");
        }
        if ($this->current_page < ($this->pages_count - $this->mid_size)) {
            $end = $this->createButtonArrow("end", $this->pages_count, "&raquo;");
        }

        for ($i = 1; $i <= $this->mid_size; $i++) {
            if ($this->current_page + $i <= $this->pages_count) {
                $right_mid .= $this->createButtonNum("mid right", $this->current_page + $i);
            }
        }

        for ($i = $this->mid_size; $i > 0; $i--) {
            if ($this->current_page - $i > 0) {
                $left_mid .= $this->createButtonNum("mid left", $this->current_page - $i);
            }
        }

        $output = "<nav aria-label='Posts navigation'><ul class='pagination'>";
        $output .= $start;
        $output .= $prev;
        $output .= $left_mid;

        // $output .= "   <li class='page-item active'>
        //                     <a class='page-link' href='#' aria-label='Current'>
        //                         <span aria-hidden='true'>".$this->current_page."</span>
        //                     </a>
        //                </li>";

        $output .= $this->createButtonNum("current", $this->current_page, true);

        $output .= $right_mid;
        $output .= $next;
        $output .= $end;
        $output .= "</ul></nav>";

        return $output;
    }

    private function getLink($page)
    {
        if ($page == 1) {
            return rtrim($this->uri, '?&');
        }
        if (str_contains($this->uri, '&') || str_contains($this->uri, '?')) {
            return "{$this->uri}page={$page}";
        } else {
            return "{$this->uri}?page={$page}";
        }
    }

    private function createButtonNum($label, $page_num, $active = false)
    {
        return "<li class='page-item" . ($active == true ? " active" : "") . "'>
                    <a class='page-link' href='" . $this->getLink($page_num) . "' aria-label='$label'>
                        <span aria-hidden='true'>$page_num</span>
                    </a>
                </li>";
    }

    private function createButtonArrow($label, $page_num, $arrow)
    {
        return "<li class='page-item'>
                    <a class='page-link' href='" . $this->getLink($page_num) . "' aria-label='$label'>
                        <span aria-hidden='true'>$arrow</span>
                    </a>
                </li>";
    }

    public function __tostring()
    {
        return $this->listPages();
    }

    private function getMidSize()
    {
        return $this->pages_count <= $this->all_pages ? $this->pages_count : $this->mid_size;
    }
}


