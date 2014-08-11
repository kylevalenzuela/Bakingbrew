<?php
/**
 * Baking Brew functions and definitions
 *
 * @package Baking Brew
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'baking_brew_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function baking_brew_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Baking Brew, use a find and replace
	 * to change 'baking-brew' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'baking-brew', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'baking-brew' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'baking_brew_custom_background_args', array(
		'default-color' => '919191',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
}
endif; // baking_brew_setup
add_action( 'after_setup_theme', 'baking_brew_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */


/**
 * Enqueue scripts and styles.
 */
function baking_brew_scripts() {
	wp_enqueue_style( 'baking-brew-style', get_stylesheet_uri() );
    
    wp_register_script('app' , get_bloginfo('template_directory') . "/js/app.js");
    wp_enqueue_script('app');

    wp_register_script('picturefill' , get_bloginfo('template_directory') . "/js/picturefill.js");
    wp_enqueue_script('picturefill');

    wp_enqueue_script( 'baking-brew-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
    	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    		wp_enqueue_script( 'comment-reply' );
    	}
    }
    add_action( 'wp_enqueue_scripts', 'baking_brew_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/*
WordPress Post Like System
*/
 
/**
 * Enqueue scripts for like system
 */
function like_scripts() {
    wp_enqueue_script( 'jm_like_post', get_template_directory_uri().'/js/post-like.js' );
    wp_localize_script( 'jm_like_post', 'ajax_var', array(
        'url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'ajax-nonce' )
        )
    );
}
add_action( 'init', 'like_scripts' );

/**
 * Add Fontawesome Icons
 */
function enqueue_icons () {
    wp_register_style( 'icon-style', 'http://netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css' );
    wp_enqueue_style( 'icon-style' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_icons' );

/**
 * Save like data
 */
add_action( 'wp_ajax_nopriv_jm-post-like', 'jm_post_like' );
add_action( 'wp_ajax_jm-post-like', 'jm_post_like' );

function jm_post_like() {
    $nonce = $_POST['nonce'];
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Nope!' );

    if ( isset( $_POST['jm_post_like'] ) ) {

        $post_id = $_POST['post_id']; // post id
        $post_like_count = get_post_meta( $post_id, "_post_like_count", true ); // post like count

        if ( is_user_logged_in() ) { // user is logged in
            $user_id = get_current_user_id(); // current user
            $meta_POSTS = get_user_option( "_liked_posts", $user_id  ); // post ids from user meta
            $meta_USERS = get_post_meta( $post_id, "_user_liked" ); // user ids from post meta
            $liked_POSTS = NULL; // setup array variable
            $liked_USERS = NULL; // setup array variable

            if ( count( $meta_POSTS ) != 0 ) { // meta exists, set up values
                $liked_POSTS = $meta_POSTS;
            }

            if ( !is_array( $liked_POSTS ) ) // make array just in case
                $liked_POSTS = array();

            if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values
                $liked_USERS = $meta_USERS[0];
            }       

            if ( !is_array( $liked_USERS ) ) // make array just in case
                $liked_USERS = array();

            $liked_POSTS['post-'.$post_id] = $post_id; // Add post id to user meta array
            $liked_USERS['user-'.$user_id] = $user_id; // add user id to post meta array
            $user_likes = count( $liked_POSTS ); // count user likes

            if ( !AlreadyLiked( $post_id ) ) { // like the post
                update_post_meta( $post_id, "_user_liked", $liked_USERS ); // Add user ID to post meta
                update_post_meta( $post_id, "_post_like_count", ++$post_like_count ); // +1 count post meta
                update_user_option( $user_id, "_liked_posts", $liked_POSTS ); // Add post ID to user meta
                update_user_option( $user_id, "_user_like_count", $user_likes ); // +1 count user meta
                echo $post_like_count; // update count on front end

            } else { // unlike the post
                $pid_key = array_search( $post_id, $liked_POSTS ); // find the key
                $uid_key = array_search( $user_id, $liked_USERS ); // find the key
                unset( $liked_POSTS[$pid_key] ); // remove from array
                unset( $liked_USERS[$uid_key] ); // remove from array
                $user_likes = count( $liked_POSTS ); // recount user likes
                update_post_meta( $post_id, "_user_liked", $liked_USERS ); // Remove user ID from post meta
                update_post_meta($post_id, "_post_like_count", --$post_like_count ); // -1 count post meta
                update_user_option( $user_id, "_liked_posts", $liked_POSTS ); // Remove post ID from user meta          
                update_user_option( $user_id, "_user_like_count", $user_likes ); // -1 count user meta
                echo "already".$post_like_count; // update count on front end

            }

        } else { // user is not logged in (anonymous)
            $ip = $_SERVER['REMOTE_ADDR']; // user IP address
            $meta_IPS = get_post_meta( $post_id, "_user_IP" ); // stored IP addresses
            $liked_IPS = NULL; // set up array variable

            if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
                $liked_IPS = $meta_IPS[0];
            }

            if ( !is_array( $liked_IPS ) ) // make array just in case
                $liked_IPS = array();

            if ( !in_array( $ip, $liked_IPS ) ) // if IP not in array
                $liked_IPS['ip-'.$ip] = $ip; // add IP to array

            if ( !AlreadyLiked( $post_id ) ) { // like the post
                update_post_meta( $post_id, "_user_IP", $liked_IPS ); // Add user IP to post meta
                update_post_meta( $post_id, "_post_like_count", ++$post_like_count ); // +1 count post meta
                echo $post_like_count; // update count on front end

            } else { // unlike the post
                $ip_key = array_search( $ip, $liked_IPS ); // find the key
                unset( $liked_IPS[$ip_key] ); // remove from array
                update_post_meta( $post_id, "_user_IP", $liked_IPS ); // Remove user IP from post meta
                update_post_meta( $post_id, "_post_like_count", --$post_like_count ); // -1 count post meta
                echo "already".$post_like_count; // update count on front end

            }
        }
    }

    exit;
}

/**
 * (4) Test if user already liked post
 */
function AlreadyLiked( $post_id ) { // test if user liked before
    if ( is_user_logged_in() ) { // user is logged in
        $user_id = get_current_user_id(); // current user
        $meta_USERS = get_post_meta( $post_id, "_user_liked" ); // user ids from post meta
        $liked_USERS = ""; // set up array variable

        if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values
            $liked_USERS = $meta_USERS[0];
        }

        if( !is_array( $liked_USERS ) ) // make array just in case
            $liked_USERS = array();

        if ( in_array( $user_id, $liked_USERS ) ) { // True if User ID in array
            return true;
        }
        return false;

    } else { // user is anonymous, use IP address for voting

        $meta_IPS = get_post_meta( $post_id, "_user_IP" ); // get previously voted IP address
        $ip = $_SERVER["REMOTE_ADDR"]; // Retrieve current user IP
        $liked_IPS = ""; // set up array variable

        if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
            $liked_IPS = $meta_IPS[0];
        }

        if ( !is_array( $liked_IPS ) ) // make array just in case
            $liked_IPS = array();

        if ( in_array( $ip, $liked_IPS ) ) { // True is IP in array
            return true;
        }
        return false;
    }

}

/**
 * Front end button
 */
function getPostLikeLink( $post_id ) {
    $like_count = get_post_meta( $post_id, "_post_like_count", true ); // get post likes
    $count = ( empty( $like_count ) || $like_count == "0" ) ? 'Like' : esc_attr( $like_count );
    if ( AlreadyLiked( $post_id ) ) {
        $class = esc_attr( ' liked' );
        $title = esc_attr( 'Unlike' );
        $heart = '<i class="fa fa-heart"></i>';
    } else {
        $class = esc_attr( '' );
        $title = esc_attr( 'Like' );
        $heart = '<i class="fa fa-heart-o"></i>';
    }
    $output = '<a href="#" class="jm-post-like'.$class.'" data-post_id="'.$post_id.'" title="'.$title.'">'.$heart.'&nbsp;'.$count.'</a>';
    return $output;
}

function getPostLikeLink_home( $post_id ) {
    $like_count = get_post_meta( $post_id, "_post_like_count", true ); // get post likes
    $count = ( empty( $like_count ) || $like_count == "0" ) ? 'Like' : esc_attr( $like_count );
    if ( AlreadyLiked( $post_id ) ) {
        $class = esc_attr( ' liked' );
        $title = esc_attr( 'Unlike' );
        $heart = '<i class="fa fa-heart heart-home"></i>';
    } else {
        $class = esc_attr( '' );
        $title = esc_attr( 'Like' );
        $heart = '<i class="fa fa-heart-o heart-home"></i>';
    }
    $output = '<div class="jm-post-like heart-home'.$class.'" data-post_id="'.$post_id.'" title="'.$title.'">'.$heart.'&nbsp;'.$count.'</div>';
    return $output;
}

/**
 * Retrieve User Likes and Show on Profile
 */
add_action( 'show_user_profile', 'show_user_likes' );
add_action( 'edit_user_profile', 'show_user_likes' );
function show_user_likes( $user ) { ?>        
    <table class="form-table">
        <tr>
            <th><label for="user_likes"><?php _e( 'You Like:' ); ?></label></th>
            <td>
            <?php
            $user_likes = get_user_option( "_liked_posts", $user->ID );
            if ( !empty( $user_likes ) && count( $user_likes ) > 0 ) {
                $the_likes = $user_likes;
            } else {
                $the_likes = '';
            }
            if ( !is_array( $the_likes ) )
            $the_likes = array();
            $count = count( $the_likes ); 
            $i=0;
            if ( $count > 0 ) {
                $like_list = '';
                echo "<p>\n";
                foreach ( $the_likes as $the_like ) {
                    $i++;
                    $like_list .= "<a href=\"" . esc_url( get_permalink( $the_like ) ) . "\" title=\"" . esc_attr( get_the_title( $the_like ) ) . "\">" . get_the_title( $the_like ) . "</a>\n";
                    if ($count != $i) $like_list .= " &middot; ";
                    else $like_list .= "</p>\n";
                }
                echo $like_list;
            } else {
                echo "<p>" . _e( 'You don\'t like anything yet.' ) . "</p>\n";
            } ?>
            </td>
        </tr>
    </table>
<?php }

/**
 * Add a shortcode to your posts instead
 * type [jmliker] in your post to output the button
 */
function jm_like_shortcode() {
    return getPostLikeLink( get_the_ID() );
}
add_shortcode('jmliker', 'jm_like_shortcode');

/**
 * If the user is logged in, output a list of posts that the user likes
 * Markup assumes sidebar/widget usage
 */
function frontEndUserLikes() {
    if ( is_user_logged_in() ) { // user is logged in
        $like_list = '';
        $user_id = get_current_user_id(); // current user
        $user_likes = get_user_option( "_liked_posts", $user_id );
        if ( !empty( $user_likes ) && count( $user_likes ) > 0 ) {
            $the_likes = $user_likes;
        } else {
            $the_likes = '';
        }
        if ( !is_array( $the_likes ) )
            $the_likes = array();
        $count = count( $the_likes );
        if ( $count > 0 ) {
            $limited_likes = array_slice( $the_likes, 0, 5 ); // this will limit the number of posts returned to 5
            $like_list .= "<aside>\n";
            $like_list .= "<h3>" . __( 'You Like:' ) . "</h3>\n";
            $like_list .= "<ul>\n";
            foreach ( $limited_likes as $the_like ) {
                $like_list .= "<li><a href='" . esc_url( get_permalink( $the_like ) ) . "' title='" . esc_attr( get_the_title( $the_like ) ) . "'>" . get_the_title( $the_like ) . "</a></li>\n";
            }
            $like_list .= "</ul>\n";
            $like_list .= "</aside>\n";
        }
        echo $like_list;
    }
}

/**
 * Outputs a list of the 5 posts with the most user likes TODAY
 * Markup assumes sidebar/widget usage
 */
function jm_most_popular_today() {
    global $post;
    $today = date('j');
    $year = date('Y');
    $args = array(
        'year' => $year,
        'day' => $today,
        'post_type' => array( 'post', 'enter-your-comma-separated-post-types-here' ),
        'meta_key' => '_post_like_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page' => 5
        );
    $pop_posts = new WP_Query( $args );
    if ( $pop_posts->have_posts() ) {
        echo "<aside>\n";
        echo "<h3>" . _e( 'Today\'s Most Popular Posts' ) . "</h3>\n";
        echo "<ul>\n";
        while ( $pop_posts->have_posts() ) {
            $pop_posts->the_post();
            echo "<li><a href='" . get_permalink($post->ID) . "'>" . get_the_title() . "</a></li>\n";
        }
        echo "</ul>\n";
        echo "</aside>\n";
    }
    wp_reset_postdata();
}

/**
 * Outputs a list of the 5 posts with the most user likes for THIS MONTH
 */
function jm_most_popular_month() {
    global $post;
    $month = date('m');
    $year = date('Y');
    $args = array(
        'year' => $year,
        'monthnum' => $month,
        'post_type' => array( 'post', 'enter-your-comma-separated-post-types-here' ),
        'meta_key' => '_post_like_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page' => 5
        );
    $pop_posts = new WP_Query( $args );
    if ( $pop_posts->have_posts() ) {
        echo "<aside>\n";
        echo "<h3>" . _e( 'This Month\'s Most Popular Posts' ) . "</h3>\n";
        echo "<ul>\n";
        while ( $pop_posts->have_posts() ) {
            $pop_posts->the_post();
            echo "<li><a href='" . get_permalink($post->ID) . "'>" . get_the_title() . "</a></li>\n";
        }
        echo "</ul>\n";
        echo "</aside>\n";
    }
    wp_reset_postdata();
}

/**
 * Outputs a list of the 5 posts with the most user likes for THIS WEEK
 */
function jm_most_popular_week() {
    global $post;
    $week = date('W');
    $year = date('Y');
    $args = array(
        'year' => $year,
        'w' => $week,
        'post_type' => array( 'post', 'enter-your-comma-separated-post-types-here' ),
        'meta_key' => '_post_like_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page' => 5
        );
    $pop_posts = new WP_Query( $args );
    if ( $pop_posts->have_posts() ) {
        echo "<aside>\n";
        echo "<h3>" . _e( 'This Week\'s Most Popular Posts' ) . "</h3>\n";
        echo "<ul>\n";
        while ( $pop_posts->have_posts() ) {
            $pop_posts->the_post();
            echo "<li><a href='" . get_permalink($post->ID) . "'>" . get_the_title() . "</a></li>\n";
        }
        echo "</ul>\n";
        echo "</aside>\n";
    }
    wp_reset_postdata();
}

/**
 * Outputs a list of the 5 posts with the most user likes for ALL TIME
 */
function jm_most_popular() {
    global $post;
    echo "<aside class='sidebar-posts'>\n";
    echo "<ul>\n";
    $args = array(
         'post_type' => array( 'post', 'page'),
         'meta_key' => '_post_like_count',
         'orderby' => 'meta_value_num',
         'order' => 'DESC',
         'posts_per_page' => 5,
         'post_parent'=> 55
         );
    $pop_posts = new WP_Query( $args );
    while ( $pop_posts->have_posts() ) {
        $pop_posts->the_post();
        echo "<li>
            
            <a href='" . get_permalink($post->ID) . "'>
            <svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'  width='32' height='32' viewBox='0 0 32 32' >
                <path d='M9.602 8.64l-0.002 14.72 12.8-7.36z' class='right-arrow'></path>
            </svg>  " . get_the_title() . "</a></li>\n";
    }
    wp_reset_postdata();
    echo "</ul>\n";
    echo "</aside>\n";
}

/**
 * Sidebar latest / recent posts widget 
 */

function most_recent_side() {
    global $post;
    echo "<aside class='sidebar-posts hidden-posts'>\n";
    echo "<ul>\n";
    $args = array(
         'post_type' => array('page'),
         'order' => 'DESC',
         'posts_per_page' => 5,
         'post_parent'=> 55
         );
    $pop_posts = new WP_Query( $args );
    while ( $pop_posts->have_posts() ) {
        $pop_posts->the_post();
        echo "<li>
            
            <a href='" . get_permalink($post->ID) . "'><svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'  width='32' height='32' viewBox='0 0 32 32' >
                <path d='M9.602 8.64l-0.002 14.72 12.8-7.36z' class='right-arrow'></path>
            </svg> " . get_the_title() . "</a></li>\n";
    }
    wp_reset_postdata();
    echo "</ul>\n";
    echo "</aside>\n";
}
/**
 * Add this around content before using CB shortcode
 */

function cb_wrap_shortcode( $atts , $content = null ) {

return '<div class="cb-wrap" >' . do_shortcode($content) . '</div>';

}

/**
 * Add checkboxes with [cb] shortcode 
 */

add_shortcode( 'cb_wrap', 'cb_wrap_shortcode' );

function checkbox_shortcode() {
    return '<span class="checkbox"></span>';
}
add_shortcode( 'cb', 'checkbox_shortcode' );

/**
 * Brewery meta box on recipe page  
 */

function meta_brew() {
    $cats = get_the_category();
    if ( !empty( $cats ) && !is_wp_error( $cats ) ){
        foreach ( $cats as $cat ) {
            echo '<div class="meta-brew-wrap" id="'.$cat->slug.'">';
            echo '<h1 class="meta-brew-title">';
            echo '<a href="';
            the_field('cellar_link');
            echo '">';
            echo $cat->name;
            echo '</a></h1>';
            echo '<p class="meta-brew-description">'.$cat->description.'</p>';
            echo '</div>';
        }
    } 
}

/**
 * Dropdown filter 
 */

function dropdown_menu() {
    echo "<div class='dropdown-wrap'>";
           echo  "<div id='dropdown' class='dropdown-items'>";
                echo "<span>Filter</span>
                <ul>";
                echo "<li><a href='" . get_permalink(117) . "'>Top Rated Daily</a></li>";
                echo "<li><a href='" . get_permalink(122) . "'>Top Rated Weekly</a></li>";
                echo "<li><a href='" . get_permalink(120) . "'>Top Rated Monthly</a></li>";
                echo "<li><a href='" . get_permalink(124) . "'>Top Rated All Time</a></li>";
                echo "<li><a href='" . get_permalink(55) . "'>Recent</a></li>";
               echo "</ul></div></div>";
}
/*
Displays list of tags 
*/
function tag_list(){
    echo "<div class='cellar-info-module'>";
    the_tags( "<div class='tag-icon mini-icon block'></div>", " ", "");
    echo "</div>";
}

/**
 * Queries blogroll most recent posts
 */

function blogroll_query() {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
      'posts_per_page' => 18,
      'paged' => $paged,
      'post_type'=> 'post',
      'order' => 'DESC'
    );

    query_posts($args); 
}

function blogroll_query_frontpage() {
    $args = array(
      'posts_per_page' => 4,
      'post_type'=> 'post',
      'order' => 'DESC'
    );

    query_posts($args); 
}

function blogroll_loop() {

    while ( have_posts() ) : the_post(); 
       
        echo "<div class='blogroll-item mat-card'>\n";
        echo "<time class=\"blogroll-time\">\n";
        the_time('l, F jS, Y');
        echo "</time>\n";
        
        echo "<a href=\"\n";
        the_permalink();
        echo "\" >\n";
        echo "<h3>\n"; 
        the_title();
        echo "</h3>\n";
        echo "</a>\n";
        echo "<div class=\"blogroll-excerpt\">\n";
        the_excerpt();
        echo "</div>\n";
        echo "<a class=\"blogroll-more\" href=\" \n";
        the_permalink();
        echo " \">Read More \n";  
        include('icons/arrow-right.svg');
        echo "</a>\n";
        echo "<div class='cellar-info-module'>";
        the_tags( "<div class='tag-icon mini-icon block'></div>", " ", "");
        echo "</div>";
        echo "</div>\n";

    endwhile;
}

//
//
//HOME PAGE QUERY AND LOOPS 
//


// query home page post's Brewery info 

function meta_query(){
    $cats = get_the_category();
    if ( !empty( $cats ) && !is_wp_error( $cats ) ){
        foreach ( $cats as $cat ) {
            echo "<div id='". $cat->slug. "' class='inline'>";
            echo "<a href='";
            the_field('cellar_link');
            echo "'>";
            echo $cat->name;
            echo "</a>";
            echo "</div>";
        }
    }
}

//MAIN POST LOOP (1 POST)

function home_most_recent() {
    $args = array(
        'post_type'=> 'page',
        'post_parent'=> 55,
        'order' => 'DESC',
        'posts_per_page' => 1
    );

    query_posts($args); 
    while ( have_posts() ) : the_post(); 
    echo "<article class='main-recipe'>\n";
    echo "<div class='main-recipe-img'>\n";
   
    echo "<a href='";
    the_permalink();
    echo "'>";
    echo "<div class='main-recipe-img'><picture>";
    echo "<source srcset='";
    the_field('home_main_big');
    echo "'";
    echo "media='(min-width: 800px)'>";
    echo "<img srcset='"; 
    the_field('home_main_small'); 
    echo "'></picture></div></a>";
    echo "<div class='main-recipe-block'>";
    echo "<a href='";
    the_permalink();
    echo "'>";
    echo "<h5>";
    the_title();
    echo "</h5>";
    echo "</a>";    
    echo "<div class='cellar-info-module'>";
    echo "<div class='cellar-icon mini-icon '></div>";
    meta_query();    
    echo "<div class='cellar-info-tags'>";
    the_tags( "<div class='tag-icon mini-icon block'></div>", " ", "");
    echo "</div>";
    echo "</div></div></article>";
    endwhile; 

}


//RECENT POST LOOP (3 POSTS)

function home_sub_recent(){
    $args = array(
        'post_type'=> 'page',
        'post_parent'=> 55,
        'order' => 'DESC',
        'offset' => -1,
        'posts_per_page' => 3
    );

    query_posts($args); 


    while ( have_posts() ) : the_post(); 

        echo "<div class='recent-recipe-block'>";
        echo "<div class='recent-recipe-article'>";
        echo "<a href='";
        the_permalink();
        echo "'>";
            echo "<h5>";
                the_title();
            echo "</h5>";
        echo "</a>";
        echo "<div class='cellar-info-module block'>";
        echo "<div class='cellar-icon mini-icon'></div>";
        meta_query();
        echo "</div>";
        echo "<div class='cellar-info-module inline'>";
        the_tags( "<div class='tag-icon mini-icon'></div>", " ", ""); 
        echo "</div>";
        echo "</div>";
        echo "<a href='";
        the_permalink();
        echo "'>";
        echo "<div class='recent-recipe-img'>";
        echo "<img src='";
        the_field('home_sub'); 
        echo "' alt='Feature Article Image'>";
        include('icons/multibread.svg');
        echo "</div></a></div>";

    endwhile; 
}

function cellar_loop() {
    
    $categories = get_the_category();
    $category_id = $categories[0]->cat_ID;

    $args = array(
        'post_type'=> 'page',
        'post_parent'=> 55,
        'cat'=> $category_id,
        'order' => 'DESC',
    );
    $the_query = new WP_Query( $args );
    while ( $the_query->have_posts() ) : $the_query->the_post();
        echo '<div class="reciperoll-item">';
        echo '<a href="';
        the_permalink();
        echo '" />';
        echo '<img src="';
        the_field('reciperoll_image');
        echo '"> ';
        echo '<span>';
        echo '<div class="rr-item-wrap">';
        echo '<h6>';
        the_title();
        echo '</h6>';
        echo '</div>';
        echo '</span>';
        echo '</a>';
        echo '</div>';

        $categories = get_the_category();
        $category_id = $categories[0]->cat_ID;

    endwhile; wp_reset_postdata();

}

function fix_excerpt_more($more){
    $more = '...';
    return $more;
}
add_filter('excerpt_more', 'fix_excerpt_more');

function cellarroll_brew_img() {
    echo "<div class='cellarroll-item-img'><a href='";
    the_permalink();
    echo "'><img src='";
    the_field('cellarrollimg');
    echo "'></a></div>";
}

function cellarroll_brew_img_home() {
    echo "<div class='cellarroll-item-img-home'><a href='";
    the_permalink();
    echo "'><img src='";
    the_field('cellarrollimg');
    echo "'></a></div>";
}

function cellarroll_brew_img_main() {
    echo "<div class='cellarroll-item-img-main'><a href='";
    the_permalink();
    echo "'><img src='";
    the_field('cellarrollimg');
    echo "'></a></div>";
}

function cellarroll_loop() {

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'paged' => $paged,
                    'post_type'=> 'page',
                    'post_parent'=> 33,
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'posts_per_page' => 18
                );
    query_posts($args); 
    while ( have_posts() ) : the_post(); 
       
        echo "<div class='blogroll-item mat-card cellar-item'>\n";
        echo "<div class='cellarroll-item-wrap'>\n";
        cellarroll_brew_img();
        echo "<div class='cellarroll-item-content'>";
        echo "<a href=\"\n";
        the_permalink();
        echo "\" >\n";
        echo "<h3>\n"; 
        the_title();
        echo "</h3>\n";
        echo "</a>\n";
        echo "<div class=\"blogroll-excerpt\">\n";
        the_excerpt();
        echo "</div>\n";
        echo "<a class=\"blogroll-more\" href=\" \n";
        the_permalink();
        echo " \">Read More \n";  
        include('icons/arrow-right.svg');
        echo "</a>\n";
        echo "</div>\n";
        echo "</div>\n";
        echo "</div>\n";
    endwhile;
}

function next_post_slideout(){
    echo "<div class='next-post-slideout cards'>";
    next_post_link(); 
    echo "</div>";
}

function recipe_roll_query_recent() {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
      'posts_per_page' => 18,
      'paged' => $paged,
      'post_type'=> 'page',
      'post_parent'=> 55,
      'order' => 'DESC'
    );
    query_posts($args); 
}
function recipe_roll_query_monthly() {
    $month = "date('m')";
    $year = "date('Y')";    
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'paged' => $paged,
        'post_type'=> 'page',
        'post_parent'=> 55,
        'year' => $year,
        'month' => $month,
        'meta_key' => '_post_like_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page' => 18



    );
    query_posts($args); 
}

function recipe_roll_query_weekly() {
    global $post;
    $week = "date('W')";
    $year = "date('Y')";
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'posts_per_page' => 18,
        'paged' => $paged,
        'post_type'=> 'page',
        'post_parent'=> 55,
        'year' => $year,
        'w' => $week,
        'meta_key' => '_post_like_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
    );
    query_posts($args); 
}

function recipe_roll_query_daily() {
    global $post;
    $today = "date('j')";
    $year = "date('Y')";
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'posts_per_page' => 18,
        'paged' => $paged,
        'post_type'=> 'page',
        'post_parent'=> 55,
        'year' => $year,
        'day' => $today,
        'meta_key' => '_post_like_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
    );
    query_posts($args);
}

function recipe_roll_query_alltime() {
    global $post;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'posts_per_page' => 18,
        'paged' => $paged,
        'post_type'=> 'page',
        'post_parent'=> 55,
        'order' => 'DESC',
        'meta_key' => '_post_like_count',
        'orderby' => 'meta_value_num'
    );
    query_posts($args); 
}

function recipe_roll() {
    while ( have_posts() ) : the_post();
    echo "<div class='reciperoll-item'>";
    echo "<a href='";
    the_permalink(); 
    echo "'>";
    echo "<img src='";
    the_field("reciperoll_image"); 
    echo "'>"; 
    echo "<span><div class='rr-item-wrap'><h6>";
    the_title();
    echo "</h6></div></span></a></div>";
    endwhile;
}

function recipe_roll_pagination() {
    global $wp_query;

    $big = 999999999; // need an unlikely integer
    $translated = __( 'Page', 'mytextdomain' ); // Supply translatable string

    echo paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
            'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
    ) );
    wp_reset_query(); 
}
function home_cellar_slide() {
    $args = array(
        'post_type'=> 'page',
        'meta_key' => '_post_like_count',
        'orderby' => 'meta_value_num',
        'post_parent'=> 33,
        'order' => 'DESC',
        'posts_per_page' => 4
    );
    query_posts($args); 

    while ( have_posts() ) : the_post(); 
    echo "<div class='home-cellar-content'>";
    echo "<div class='home-cellar-img'>";
    cellarroll_brew_img_home();
    echo "</div>";
    echo "<div class='home-cellar-block'>";
    echo "<a href='";
    the_permalink();
    echo "'>";
    echo "<h4>";
    the_title();
    echo "</h4></a>";
    echo "<div class='bread-module'>";
    echo "<span class='likes'>";
    echo getPostLikeLink_home( get_the_ID() ); 
    echo "</span>";
    echo "</div>";
    echo "</div></div>";
    endwhile;       
}

function share_buttons() {
    echo "<ul class='share-buttons'>";
    echo "<li class='share-twitter'><a href='http://twitter.com/home?status=";
    print(urlencode(the_title()));
    echo "+";
    print(urlencode(get_permalink())); 
    echo "'>Twitter</a></li>";
    echo "<li class='share-facebook'><a href='http://www.facebook.com/share.php?u=";
    print(urlencode(get_permalink())); 
    echo "&title=";
    print(urlencode(get_permalink())); 
    echo "'>Facebook</a></li>";
    echo "<li class='share-google'><a href='https://plus.google.com/share?url=";
    print(urlencode(get_permalink())); 
    echo "'>Google+</a></li>";
    echo "<li class='share-pinterest'><a href='http://pinterest.com/pin/create/bookmarklet/?media=";
    the_field('headerimage');
    echo "&url=";
    print(urlencode(get_permalink()));
    echo "&is_video=false&description=";
    print(urlencode(the_title()));
    echo "'>Pinterest</a></li>";
    echo "<li class='share-reddit'><a href='http://www.reddit.com/submit?url=";
    print(urlencode(get_permalink()));
    echo "&title=";
    print(urlencode(the_title()));
    echo "'>Reddit</a></li>";
    echo "<li class='share-evernote'><a href='http://www.evernote.com/clip.action?url=";
    print(urlencode(get_permalink()));
    echo "&title=";
    print(urlencode(the_title()));
    echo "'>Evernote</a></li>";
    echo "<li class='share-mail'><a href='mailto:?subject=";
    print(urlencode(the_title()));
    echo "&amp;body=Post from ";
    print(urlencode(get_permalink()));
    echo "' title='Share by Email'>Email</a></li>";
    echo "</ul>";
}

function brewery_meta_info() {
    echo "<ul class='brewery-meta-info'>";
    echo "<li><div class='location-svg svg-ico'></div>";
    the_field('brew-city');
    echo "</li>";
    echo "<li><div class='twitter-svg svg-ico'></div><a href='";
    the_field('brew-twitter');
    echo "'>Twitter</a></li>";
    echo "<li><div class='globe-svg svg-ico'></div><a href='";
    the_field('brew-website');
    echo"'>Website</a></li>";
    echo "</ul>";
}


