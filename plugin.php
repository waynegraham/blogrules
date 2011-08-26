<?php
/**
 * Plugin Name: Scholars' Lab Admin Rules Plugin
 * Plugin URI:
 * Description: Legal statement
 * Version: 1.0
 * Author: Wayne Graham
 * Author URI: https://github.com/wayne_graham
 * License: Apache2
 */


add_action( 'wp_dashboard_setup', 'add_blog_rules' );

/**
 * Move widget to the top
 */
function add_blog_rules() 
{
  wp_add_dashboard_widget('blog_rules_widget', 'Red Tape', 'print_the_rules_function');

  // Globalize the metaboxes array, this holds all the widgets for wp-admin
  global $wp_meta_boxes;

  // Get the regular dashboard widgets array
  // (which has our new widget already but at the end)
  $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

  // Backup and delete our new dashbaord widget from the end of the array
  $blog_widget_backup = array('blog_rules_widget' => $normal_dashboard['blog_rules_widget']);
  unset($normal_dashboard['blog_rules_widget']);

  // Merge the two arrays together so our widget is at the beginning
  $sorted_dashboard = array_merge($blog_widget_backup, $normal_dashboard);

  // Save the sorted array back into the original metaboxes
  $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}

function print_the_rules_function() 
{
  echo <<< EOT
    <p><strong>Purpose and Scope of this Blog:</strong> This shared blog has been created
    under the ownership and control of the University of Virginia Library exclusively for
    postings by Scholars' Lab Graduate Fellows, Scholars' Lab Student Consultants, faculty
    and staff of the Digital Research &amp; Scholarship Department of UVA Library, and invited
    guest scholars.  Its purpose is to highlight research done in collaboration with the
    Scholars' Lab or relating to themes and issues relevant to digital scholarship in the
    humanities and social sciences.  All submitted posts will be reviewed for content and
    relevancy before being published online, and the Scholars' Lab reserves the right to
    request revisions or refuse to publish a given submission. Posts and comments will appear
    on this blog subject to the standards of responsible civil discourse and sound scholarship.
    In other words, the Scholars' Lab blog has been established to further defined objectives
    of the University of Virginia Library and does not constitute a forum for general expression.</p>
    <p><strong>Legal Responsibilities:</strong> you agree that it is your individua
    responsibility to adhere to all applicable legal requirements including copyrigh
    law, and that you have not posted content that is defamatory of or harmful to the
    legal rights of others.   You represent and warrant that you either own or have
    received permission to post the all content submitted, or have included short excerpts
    from the original works of others for scholarly commentary or illustration, in a
    manner that is consistent with fair use guidelines under US copyright law.
    <p>
    <p><strong>Publication Rules:</strong> All contributions will be published under a Creative Commons Attribution-ShareAlike Public Use License.  Under the terms of this license, you permit free distribution, display, and/or performance of your submitted works of authorship, so long as you are credited by name each time your content is utilized.  This license does not interfere with your personal ability to reuse or republish content you post here, either in a commercial or noncommercial context.  </p>
    <p><strong>Preservation:</strong> The University of Virginia Library does not promise backup, restoration, continued maintenance, or dedicated archiving of posts on this blog.  Any questions about these policies should be directed to Bethany Nowviskie, Director of Digital Research & Scholarship, UVA Library.  </p>
    <p><strong>YOUR SUBMISSION OF POSTS INDICATES YOUR AGREEMENT WITH ALL OF THE ABOVE TERMS</strong></p>
EOT;
}


