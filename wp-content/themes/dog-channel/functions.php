<?php
function dogchannel_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_script( 'dogchannel', get_stylesheet_directory_uri() . '/js/dogchannel.js', array( 'jquery' ), '', true );
}
add_action('wp_enqueue_scripts', 'dogchannel_enqueue_styles');


add_filter( 'document_title_parts', 'wp_remove_title_sitename' );
  function wp_remove_title_sitename( $title ) {
    if ( is_search() || is_404() || is_author() || is_tag() ) {
    unset( $title['site'] );
    }
    return $title;
  }

// breadcrumb list
if (!function_exists('wp_breadcrumb')) {
  function wp_breadcrumb($divOption = array("id" => "wp_breadcrumb", "class" => "wp_breadcrumb inner wrap cf")){
      global $post;
      $str ='';
      if(!get_option('side_options_pannavi')){
        if(!is_home()&&!is_front_page()&&!is_admin() ){
            $tagAttribute = '';
            foreach($divOption as $attrName => $attrValue){
                $tagAttribute .= sprintf(' %s="%s"', $attrName, $attrValue);
            }
            $positionNum = 1;
            $str.= '<div'. $tagAttribute .'>';
            $str.= '<ol itemscope itemtype="http://schema.org/BreadcrumbList">';
            $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'. esc_url( home_url() ) .'/" itemprop="item"><span itemprop="name">HOME</span></a><meta itemprop="position" content="' . $positionNum++ . '" /></li>';

            if(is_category()) {
                $cat = get_queried_object();
                if($cat -> parent != 0){
                    $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
                    foreach($ancestors as $ancestor){
                        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'. esc_url( get_category_link($ancestor) ) .'" itemprop="item"><span itemprop="name">'. esc_html( get_cat_name($ancestor) ) .'</span></a><meta itemprop="position" content="' . $positionNum++ . '" /></li>';
                    }
                }
                $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" aria-current="page">'. $cat -> name . '</span><meta itemprop="position" content="' . $positionNum++ . '" /></li>';
            } elseif(is_single()){
                $categories = get_the_category($post->ID);
                $cat = $categories[0];
                if($cat -> parent != 0){
                    $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
                    foreach($ancestors as $ancestor){
                        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'. esc_url( get_category_link($ancestor) ).'" itemprop="item"><span itemprop="name">'. esc_html( get_cat_name($ancestor) ). '</span></a><meta itemprop="position" content="' . $positionNum++ . '" /></li>';
                    }
                }
                $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'. esc_url( get_category_link($cat -> term_id) ). '" itemprop="item"><span itemprop="name">'. $cat-> cat_name . '</span></a><meta itemprop="position" content="' . $positionNum++ . '" /></li>';
                $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" aria-current="page">'. $post -> post_title .'</span><meta itemprop="position" content="' . $positionNum++ . '" /></li>';
            } elseif(is_page()){
                if($post -> post_parent != 0 ){
                    $ancestors = array_reverse(get_post_ancestors( $post->ID ));
                    foreach($ancestors as $ancestor){
                        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'. get_permalink($ancestor).'" itemprop="item"><span itemprop="name">'. esc_html( get_the_title($ancestor) ) .'</span></a><meta itemprop="position" content="' . $positionNum++ . '" /></li>';
                    }
                }
                $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" aria-current="page">'. $post -> post_title .'</span><meta itemprop="position" content="' . $positionNum++ . '" /></li>';
             } else{
                $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" aria-current="page">'. wp_get_document_title('', false) .'</span><meta itemprop="position" content="' . $positionNum++ . '" /></li>';
            }
            $str.='</ol>';
            $str.='</div>';
        }
    }
      echo $str;
  }
}

// Year of issue
function get_first_post_year(){
  $year = null;
  query_posts('posts_per_page=1&order=ASC');
  if ( have_posts() ) : while ( have_posts() ) : the_post();
    $year = intval(get_the_time('Y'));
  endwhile; endif;
  wp_reset_query();
  return $year;
}
 
//Copyright
function get_copylight_credit(){
  $site_tag = get_bloginfo('name');
  return '&copy; '.get_first_post_year().' '.$site_tag;
}
?>