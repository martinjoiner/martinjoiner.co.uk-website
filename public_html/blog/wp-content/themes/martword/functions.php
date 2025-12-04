<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'functions.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

$themename = "LightWord";
$shortname = "lw";

$options = array (

    array(	"name" => "Welcome",
			"type" => "title"),

	array(	"type" => "open"),

    array(  "name" => __('Layout settings', 'lightword'),
            "id" => $shortname."_layout_settings",
            "options" => array(__('Original','lightword'), __('Wider','lightword')),
            "std" => __('Original','lightword'),
            "type" => "select"),

    array(  "name" => __('Christmas Joy','lightword'),
			"desc" => __('Because its Christmas! Happy Holidays and thanks for downloading LightWord theme','lightword'),
            "id" => $shortname."_christmas_joy",
            "type" => "checkbox",
            "std" => "false"),

    array(  "name" => __('Disable comments on pages','lightword'),
			"desc" => __('Check this box if you would like to DISABLE COMMENTS on pages','lightword'),
            "id" => $shortname."_disable_comments",
            "type" => "checkbox",
            "std" => "false"),

    array(  "name" => __('Custom image header','lightword'),
			"desc" => __('Check this box if you would like to SHOW IMAGE instead Cufon text on header.<br/>Image location: <code>lightword/images/header-image.png</code> / Max width: <code>796px</code>','lightword'),
            "id" => $shortname."_top_header_image",
            "type" => "checkbox",
            "std" => "false"),

    array(  "name" => __('Header image height in pixels','lightword'),
			"desc" => '',
            "id" => $shortname."_top_header_image_height",
            "type" => "header_image",
            "std" => "56"),

    array(  "name" => __('About author feature', 'lightword'),
            "desc" => __('Add information about post author','lightword'),
            "id" => $shortname."_post_author",
            "options" => array(__('Disabled','lightword'), __('Main page','lightword'), __('Single page','lightword'), __('Both','lightword')),
            "std" => __('Disabled','lightword'),
            "type" => "select"),

    array(  "name" => __('Enjoy this post feature','lightword'),
			"desc" => __('Check this box if you would like to ACTIVATE <em>Enjoy this post</em> feature','lightword'),
            "id" => $shortname."_enjoy_post",
            "type" => "checkbox",
            "std" => "false"),

    array(  "name" => __('Show categories on front menu','lightword'),
			"desc" => __('Check this box if you would like to SHOW CATEGORIES instead pages on front menu','lightword'),
            "id" => $shortname."_show_categories",
            "type" => "checkbox",
            "std" => "false"),

    array(  "name" => __('Exclude pages from front menu','lightword'),
			"desc" => __('Type the pages id in the box below. Example input: <code>5,19,24</code>','lightword'),
            "id" => $shortname."_exclude_pages",
            "type" => "exclude_pages",
            "std" => ""),

    array(  "name" => __('Exclude categories from front menu','lightword'),
			"desc" => __('Type the categories id in the box below. Example input: <code>5,19,24</code>','lightword'),
            "id" => $shortname."_exclude_categories",
            "type" => "exclude_categories",
            "std" => ""),

    array(  "name" => __('Remove search box','lightword'),
			"desc" => __('Remove search box and expand space for front menu','lightword'),
            "id" => $shortname."_remove_searchbox",
            "type" => "checkbox",
            "std" => "false"),

    array(  "name" => __('Remove tags from posts','lightword'),
			"desc" => __('Show only categories in post footer','lightword'),
            "id" => $shortname."_disable_tags",
            "type" => "checkbox",
            "std" => "false"),

    array(  "name" => __('Remove RSS badge','lightword'),
			"desc" => __('Remove RSS badge from blog header','lightword'),
            "id" => $shortname."_remove_rss",
            "type" => "checkbox",
            "std" => "false"),

    array(  "name" => 'Google Custom Search Engine',
			"desc" => __('Find <code>name="cx"</code> in the <strong>Search box code</strong> of Google CSE, and type the <code>value</code> here.','lightword'),
            "id" => $shortname."_google_search_code",
            "type" => "text",
            "std" => ""),

    array(  "name" => __('Sidebox settings', 'lightword'),
            "id" => $shortname."_sidebox_settings",
            "options" => array(__('Enabled','lightword'), __('Disabled','lightword'), __('Show only date','lightword'), __('Show only in posts','lightword'), __('Last two options together','lightword')),
            "std" => __('Enabled','lightword'),
            "type" => "select"),

    array(  "name" => __('Sidebar settings', 'lightword'),
            "id" => $shortname."_sidebar_settings",
            "desc" => __('Two sidebars option is available on Wider layout only','lightword'),
            "options" => array(__('One sidebar','lightword'), __('Two sidebars','lightword')),
            "std" => __('One sidebar','lightword'),
            "type" => "select"),

    array(  "name" => __('Custom CSS', 'lightword'),
			"desc" => __('Put your custom css code here','lightword'),
            "id" => $shortname."_custom_css",
            "type" => "textarea",
            "std" => ""),

    array(  "name" => __('AdSense', 'lightword'),
			"desc" => __('Copy your AdSense code and paste it here.','lightword'),
            "id" => $shortname."_adsense_spot",
            "type" => "textarea",
            "std" => ""),

	array(	"type" => "close")


);

// ADMIN PAGE FUNCTIONS

function lightword_admin() {
global $themename, $shortname, $options;

if ( $_GET['page'] == basename(__FILE__) ) {
if ( 'save' == $_REQUEST['action'] ) {

foreach ($options as $value) {
update_option( $value['id'], stripslash_check($_REQUEST[ $value['id'] ]) ); }

foreach ($options as $value) {
if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], stripslash_check($_REQUEST[ $value['id'] ])  ); } else { delete_option( $value['id'] ); } }
header("Location: themes.php?page=functions.php&saved=true");
die;

} else if( 'reset' == $_REQUEST['action'] ) {
foreach ($options as $value) {
delete_option( $value['id'] ); }
header("Location: themes.php?page=functions.php&reset=true");
die;
}
}
add_theme_page("MartWord Settings", __('MartWord Settings','lightword'), 'edit_themes', basename(__FILE__), 'lightword_admin_page');
}

// ADMIN PAGE LAYOUT

function lightword_admin_page() {
global $themename, $themeversion, $shortname, $options, $lw_top_header_image, $top_header_image_height, $lw_show_categories;
if ( $_REQUEST['saved'] ) { echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '; _e('settings saved','lightword'); echo '.</strong></p></div>'; }
if ( $_REQUEST['reset'] ) { echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '; _e('settings reset','lightword'); echo '.</strong></p></div>'; }
?>
<div class="wrap">

<h2><?php _e('MartWord Settings','lightword') ?></h2>

<div id="poststuff" class="metabox-holder">

<div class="stuffbox">
<h3><label for="link_url"><?php _e('General settings','lightword'); ?></label></h3>
<div class="inside">
<form method="post">
<?php foreach ($options as $value) { switch ( $value['type'] ) { case "open": ?>
<table width="100%" border="0" style="padding:10px;">
<?php break; case "close": ?>
</table><br />
<?php break;case 'text':?>

<tr><td width="20%" rowspan="2" valign="middle"><strong style="font-size:11px;"><?php echo $value['name']; ?></strong></td>
<td width="80%"><input style="width:300px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
</tr><tr><td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #E1E1E1;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php break;case 'textarea':?>

<tr><td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
<td width="90%"><textarea name="<?php echo $value['id']; ?>" style="width:500px; height:150px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?></textarea></td></tr>
<tr><td><small><?php echo $value['desc']; ?></small></td>
</tr><tr></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php break; case 'select': ?>
<tr>
<td width="20%" rowspan="2" valign="middle"><strong style="font-size:11px;"><?php _e("".$value['name']."","lightword"); ?></strong></td>
<td width="80%"><select style="width:200px;" name="<?php _e("".$value['id']."","lightword"); ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?> value="<?php echo $option; ?>"><?php _e("".$option."","lightword"); ?></option><?php } ?></select></td>
</tr><tr><td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #E1E1E1;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php break; case 'header_image': ?>
<?php if($lw_top_header_image == "true") : ?>
<tr>
<td width="20%" rowspan="2" valign="middle"><strong style="font-size:11px;"><?php _e("".$value['name']."","lightword"); ?></strong></td>
<td width="80%"><input style="width:50px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
</tr><tr><td></td></tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #E1E1E1;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
<?php endif; ?>

<?php break; case 'exclude_pages': ?>
<?php if($lw_show_categories == "false" || $lw_show_categories == "") : ?>
<tr>
<td width="20%" rowspan="2" valign="middle"><strong style="font-size:11px;"><?php _e("".$value['name']."","lightword"); ?></strong></td>
<td width="80%"><input style="width:300px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
</tr><tr><td><small><?php _e("".$value['desc']."","lightword"); ?></small></td></tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #E1E1E1;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
<?php endif; ?>

<?php break; case 'exclude_categories': ?>
<?php if($lw_show_categories == "true") : ?>
<tr>
<td width="20%" rowspan="2" valign="middle"><strong style="font-size:11px;"><?php _e("".$value['name']."","lightword"); ?></strong></td>
<td width="80%"><input style="width:300px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
</tr><tr><td><small><?php _e("".$value['desc']."","lightword"); ?></small></td></tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #E1E1E1;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
<?php endif; ?>

<?php break; case "checkbox": ?>
<tr>
<td width="25%" rowspan="2" valign="middle"><strong style="font-size:11px;"><?php _e("".$value['name']."","lightword"); ?></strong></td>
<td width="75%"><?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />   <small><?php _e("".$value['desc']."","lightword"); ?></small>
</td></tr><tr></tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #E1E1E1;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
<?php break; } } ?>
</div></div>
<p class="submit" style="margin-top:-2em;">
<input name="save" type="submit" value="<?php _e('Save changes','lightword'); ?>" class="button-primary" />
<input type="hidden" name="action" value="save" />
</p>
</form>

<div class="stuffbox">
<h3><label for="link_url"><?php _e('Search for help','lightword'); ?> (<a href="http://www.lightwordtheme.net/">blog</a> <?php _e('or','lightword'); ?> <a href="http://twitter.com/andreiluca">twitter</a>)</label></h3>
<div class="inside">
<?php
require_once(ABSPATH . WPINC . '/rss.php');
$rss_wp = fetch_rss('http://wordpress.org/support/rss/tags/lightword');
if ($rss_wp) {
$items_wp = array_slice($rss_wp->items, 0, 1);
foreach( $items_wp as $item_wp ) {
$pubdate = substr($item_wp['pubdate'], 0, 16);
$title = explode(' "',$item_wp['title']);
$title = strip_tags(str_replace('"','',$title[1]));
echo '<p><a href="'.$item_wp['link'].'" title="'.$title.'">'.$title.'</a> / <em>'.$pubdate.'</em></p>';
}
}else {
echo "<p>";
_e('No updates available.','lightword');
echo "</p>";
}
$rss_blog = fetch_rss('http://feeds2.feedburner.com/lightword');
if ($rss_blog) {
$items_blog = array_slice($rss_blog->items, 0, 4);
foreach( $items_blog as $item_blog ) {
$pubdate = substr($item_blog['pubdate'], 0, 16);
echo '<p><a href="'.$item_blog['guid'].'" title="'.$item_blog['title'].'">'.$item_blog['title'].'</a> / <em>'.$pubdate.'</em></p>';
}
}else {
echo "<p>";
_e('No updates available.','lightword');
echo "</p>";
}
?>
</div></div>

<div class="stuffbox">
<h3><label for="link_url"><?php _e('What is Cufon?','lightword'); ?> (<a href="http://cufon.shoqolate.com/generate/">website</a>)</label></h3>
<div class="inside">
<p>&sup1;Cuf&oacute;n is a Javascript Dynamic Text Replacement, like sIFR without flash plugin, just javascript.<br/>
<br/>&sup2;Extra Cuf&oacute;n contains (~<b>300kb js file</b>): Basic latin, uppercase, lowercase, numerals, punctuation, <br/>Latin-1 Supplement, Latin Extended-A, Cyrillic Alphabet, Russian Alphabet, Greek and Coptic; <strong>usefull for some accents and special characters</strong>.
<br/><br/>Korean characters are not supported (11000+ glyps is a bit too much - enormous file -> slow loading).</p>
</div></div>
<form method="post" style="float:right;">
<input name="reset" type="submit" value="<?php _e('Click here to reset all settings','lightword'); ?>" style="cursor:pointer;" />
<input type="hidden" name="action" value="reset" />
</form>
</div>
<?php
}

global $options;
foreach ($options as $value) {
    if (!isset($value['id']) || !isset($value['std'])) {
        continue;
    }
    if (get_option( $value['id'] ) === FALSE) {
        ${$value['id']} = $value['std'];
    } else {
        ${$value['id']} = get_option( $value['id'] );
    }
}

/**
 * count for trackback, pingback, comment, pings
 *
 * embed like this:
 * fb_comment_type_count('pings');
 * fb_comment_type_count('comment');
 * http://code.google.com/p/wp-basis-theme/
 */

 function fb_get_comment_type_count( $type='all', $zero = false, $one = false, $more = false, $post_id = 0) {
                global $cjd_comment_count_cache, $id, $post;

                if ( !$post_id )
                        $post_id = $post->ID;
                if ( !$post_id )
                        return;

                if ( !isset($cjd_comment_count_cache[$post_id]) ) {
                        $p = get_post($post_id);
                        $p = array($p);
                        fb_update_comment_type_cache($p);
                }
                ;
                if ( $type == 'pingback' || $type == 'trackback' || $type == 'comment' )
                        $count = $cjd_comment_count_cache[$post_id][$type];
                elseif ( $type == 'pings' )
                        $count = $cjd_comment_count_cache[$post_id]['pingback'] + $cjd_comment_count_cache[$post_id]['trackback'];
                else
                        $count = array_sum((array) $cjd_comment_count_cache[$post_id]);

                return apply_filters('fb_get_comment_type_count', $count);
        }

if ( !function_exists('fb_update_comment_type_cache') ) {
        function fb_update_comment_type_cache($queried_posts) {
                global $cjd_comment_count_cache, $wpdb;

                if ( !$queried_posts )
                        return $queried_posts;

                foreach ( (array) $queried_posts as $post )
                        if ( !isset($cjd_comment_count_cache[$post->ID]) )
                                $post_id_list[] = $post->ID;

                if ( $post_id_list ) {
                        $post_id_list = implode(',', $post_id_list);

                        foreach ( array('', 'pingback', 'trackback') as $type ) {
                                $counts = $wpdb->get_results("SELECT ID, COUNT( comment_ID ) AS ccount
                                                        FROM $wpdb->posts
                                                        LEFT JOIN $wpdb->comments ON ( comment_post_ID = ID AND comment_approved = '1' AND comment_type='$type' )
                            WHERE (post_status = 'publish' OR (post_status = 'inherit' AND post_type = 'attachment')) AND ID IN ($post_id_list)
                                                        GROUP BY ID");

                                if ( $counts ) {
                                        if ( '' == $type )
                                                $type = 'comment';
                                        foreach ( $counts as $count )
                                                $cjd_comment_count_cache[$count->ID][$type] = $count->ccount;
                                }
                        }
                }

                return $queried_posts;
        }

        add_filter('the_posts', 'fb_update_comment_type_cache');
}

/** Added by Steven L of ISomehowHate.com
| Fixes an issue that can occur when a user has magic_quotes switched to on.
| This ensures no \'s are added to the code which causes Google Adsense and perhaps other things to fail.
| Changes Made to Existing Code: Added stripslash_check to the update_option functions
**/

function stripslash_check($variable) {
    if ( get_magic_quotes_gpc() ) {
        $stripped = stripslashes($variable);
        return $stripped;
    }else{
        return $variable;
    }
}


/**
 * Smart cache-busting
 * http://toscho.de/2008/frisches-layout/#comment-13
 */

/*if ( !function_exists('fb_css_cache_buster') ) {
        function fb_css_cache_buster($info, $show) {
                if ($show == 'stylesheet_url') {

                        // Is there already a querystring? If so, add to the end of that.
                        if (strpos($pieces[1], '?') === false) {
                                return $info . "?" . filemtime(WP_CONTENT_DIR . $pieces[1]);
                        } else {
                                $morsels = explode("?", $pieces[1]);
                                return $info . "&" . filemtime(WP_CONTENT_DIR . $morsles[1]);
                        }
                } else {
                        return $info;
                }
        }

        add_filter('bloginfo_url', 'fb_css_cache_buster', 9999, 2);
}*/

// FRONT MENU / LIST PAGES OR CATEGORIES

function lw_wp_list_pages(){
global $lw_show_categories, $lw_exclude_pages, $lw_exclude_categories;
if ($lw_show_categories == "true") {
$top_list = wp_list_categories("echo=0&depth=2&title_li=&exclude=".$lw_exclude_categories."");
$top_list = str_replace(array('">','</a>','<span><a','current-cat"><a'),array('"><span>','</span></a>','<a','"><a class="s"'), $top_list);
return $top_list;
}else{
$top_list = wp_list_pages("echo=0&depth=2&title_li=&exclude=".$lw_exclude_pages."");
$top_list = str_replace(array('">','</a>','<span><a','current_page_item"><a'),array('"><span>','</span></a>','<a','"><a class="s"'), $top_list);
return $top_list;
}
}

// HEADER IMAGE
function lw_header_image(){
    ?>
    <div id="topBox">
        <big><a title="<?php bloginfo('name'); ?>" href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></big>
        <small class="strapLine"><?php bloginfo('description'); ?></small>
        
    </div>
    <?php
}

// COMMENTS PINGBACKS / TABS JQUERY

function comment_tabs(){
if(is_single()||is_page()){
?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/tabs.js"></script>
<script type="text/javascript">jQuery(document).ready(function(){jQuery('tabs').lightword_tabs({linkClass : 'tabs',containerClass : 'tab-content',linkSelectedClass : 'selected',containerSelectedClass : 'selected',onComplete : function(){}});});</script>
<?php
}
}


// CANONICAL COMMENTS

function canonical_for_comments() {
global $cpage, $post;
if ( $cpage > 1 ) :
echo "\n";
echo "<link rel='canonical' href='";
echo get_permalink( $post->ID );
echo "' />\n";
endif;
}

// SEARCH BOX / WORDPRESS BASIC SEARCH OR GOOGLE CSE

function lw_searchbox(){
    global $lw_remove_searchbox, $lw_google_search_code;
    $lw_google_search_code = trim(str_replace(" ","",$lw_google_search_code));
    if($lw_remove_searchbox != "true")
    if(!empty($lw_google_search_code)){
        ?>
        <form action="http://www.google.com/cse" method="get" id="searchform">
        <input type="text" class="textfield" name="q" size="24" id="s"/>
        <input type="submit" class="button" name="sa" value="" id="go"/>
        <input type="hidden" name="cx" value="<?php echo $lw_google_search_code; ?>" />
        <input type="hidden" name="ie" value="UTF-8" />
        </form>
        <?php 
    } else { ?>
        <form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
            <input type="text" value="" name="s" id="s" placeholder="<?php _e('Search'); ?>..." required> 
            <input type="submit" id="go" value="" title="<?php _e('Search'); ?>" />
        </form>
    <?php
    }
}


// SIDEBOX

function lw_show_sidebox(){
global $lw_sidebox_settings;

switch ($lw_sidebox_settings)
{
case "Enabled":
default:
echo "<div class=\"comm_date\"><span class=\"data\"><span class=\"j\">".get_the_time('j')."</span>".get_the_time('M/y')."</span><span class=\"nr_comm\">";
echo "<a class=\"nr_comm_spot\" href=\"".get_permalink()."#comments\">";
if(!comments_open()) _e('Off','lightword'); else echo fb_get_comment_type_count('comment');
echo "</a></span></div>\n";
break;

case "Disabled":
break;

case "Show only in posts":
if(is_single()){
echo "<div class=\"comm_date\"><span class=\"data\"><span class=\"j\">".get_the_time('j')."</span>".get_the_time('M/y')."</span><span class=\"nr_comm\">";
echo "<a class=\"nr_comm_spot\" href=\"".get_permalink()."#comments\">";
if(!comments_open()) _e('Off','lightword'); else echo fb_get_comment_type_count('comment')."</a>";
echo "</span></div>\n";
}
break;

case "Show only date":
/* START ONLY DATE */
echo "<div class=\"comm_date only_date\"><span class=\"data\"><span class=\"j\">".get_the_time('j')."</span>".get_the_time('M/y')."</span><span class=\"nr_comm\">";
echo "</span></div>\n";
/* END ONLY DATE */
break;

case "Last two options together":
/* START  LAST TWO */
if(is_single()){
echo "<div class=\"comm_date only_date\"><span class=\"data\"><span class=\"j\">".get_the_time('j')."</span>".get_the_time('M/y')."</span><span class=\"nr_comm\">";
echo "</span></div>\n";
}
/* END LAST TWO */
break;

} // end switch
} // end function



function lw_simple_date(){
    echo "<div class=\"simple_date\">".get_the_time('j F Y')."</div>";
}

// LEGACY COMMENTS / FOR OLD VERSION OF WORDPRESS

function legacy_comments($file) {
if(!function_exists('wp_list_comments')) : // WP 2.7-only check
$file = TEMPLATEPATH.'/legacy.comments.php';
endif;
return $file;
}

// COMMENT OPTIONS

function options_comment_link($id) {
if (current_user_can('edit_post')) {
echo '<a class="comment-edit-link" href="'.admin_url("comment.php?action=cdc&c=$id").'">'.__('delete','lightword').'</a>   ';
echo '<a class="comment-edit-link" href="'.admin_url("comment.php?action=cdc&dt=spam&c=$id").'">'.__('spam','lightword').'</a>';
edit_comment_link(__('edit','lightword'),'&nbsp;','');
}
}

// SPAM PROTECT

function check_referrer() {
    if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == ��) {
        wp_die( __('Please enable referrers in your browser, or, if you\'re a spammer, bugger off!','lightword') );
    }
}



// THREADED COMMENTS

function nested_comments($comment, $args, $depth) { $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>"><div id="comment-<?php comment_ID(); ?>">
<div class="comment_content"><div class="comment-meta commentmetadata"><div class="alignleft avatar"><?php echo get_avatar($comment,$size='36'); ?></div>
<div class="alignleft" style="padding-top:5px;"><strong class="comment_author"><?php comment_author_link() ?></strong><br/><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date(__('F jS, Y - H:i','lightword')) ?></a> <?php options_comment_link(get_comment_ID()); ?></div><div class="clear"></div></div>
<?php comment_text() ?>
<div class="reply"><?php comment_reply_link(array_merge( $args, array('reply_text' => __('( REPLY )','lightword'), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
<?php if ($comment->comment_approved == '0') : ?><span class="moderation"><?php _e('Your comment is awaiting moderation.','lightword'); ?></span><br /><?php endif; ?></div><div class="clear"></div></div>
<?php
}


// ADSENSE

function lw_adsense_spot(){
global $lw_adsense_spot;
if($lw_adsense_spot){
echo "<div align=\"center\" id=\"ad_spot\"> ";
echo $lw_adsense_spot;
echo "</div>";
}
}

// LOCALIZATION

load_theme_textdomain('lightword', get_template_directory() . '/lang');


// DASHBOARD

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets() {
   global $wp_meta_boxes;

   wp_add_dashboard_widget('custom_help_widget', 'LightWord Theme', 'custom_dashboard_help');
}

function custom_dashboard_help() {
   echo '<p>Thanks for using LightWord theme.<br/><a class="preview button" href="'.get_bloginfo('url').'/wp-admin/themes.php?page=functions.php" id="post-preview">'.__('MartWord Settings','lightword').'</a><br/></p>';
}

// SIDEBARD WIDGETS

if ( function_exists('register_sidebar') ) { register_sidebar(array('name' =>'Sidebar','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>')); }

// WORDPRESS 2.9 FEATURES

if ( function_exists( 'add_theme_support' ) ) add_theme_support( 'post-thumbnails' );

// FEATURED IMAGE SIZES

set_post_thumbnail_size( 160, 160, array( 'center', 'center') );
add_image_size( 'open-graph-image', 400, 400 );

// ENABLE FUNCTIONS

add_action('admin_menu', 'lightword_admin');

add_action('wp_footer',  'comment_tabs');
add_action( 'wp_head', 'canonical_for_comments' );
add_filter('comments_template', 'legacy_comments');

remove_action('wp_head', 'wp_generator');
remove_filter('the_content', 'wptexturize');
?>
