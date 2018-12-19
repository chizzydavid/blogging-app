<?php 
  function do_main_nav() { 
    $ul_class = 'navbar-nav ml-auto';
    $li_class = 'nav-item';
    $a_class = 'nav-link ';
    $items_array = array (
                array('text' => 'Home', 'url' => 'index.php'),
                array('text' => 'About', 'url' => 'about.php'),
                array('text' => 'Categories', 'url' => 'categories.php'),
                array('text' => 'Contact', 'url' => 'contact.php')
              );
    return navigation($items_array, $ul_class, $li_class, $a_class);
  }

  function navigation($items_array, $ul_class, $li_class, $a_class) {
    $nav = '<ul class="' . $ul_class. '">';

    foreach ($items_array as $item) {
      $nav .= '<li class="' . $li_class . '"><a class="' . $a_class. '" href="'. $item['url'].'">' .$item['text']. '</a></li>';
    }  
    $nav .= '</ul>';

    return $nav;  
}
?>