There are simple code for speed up your website. just copy and paste with creating .htacces file.



	-------------------some plugin for optimize---------------------
Optimize Database after Deleting Revisions
Use Assist cleanup plugin for everything
WP-Optimize
Autoptimize
wp super cache 
smush image compression and optimization


	---------------------follow this method------------------------
    1. Enable GZIP Compression
    2. Minify Your HTML, CSS, and JavaScript
    3. Optimize Your Above-the-Fold Content
    4. Leverage Browser Caching
    5. Optimize Your Website’s Images
    6. Avoid Landing Page Redirects
    7. Improve Your Server Response Time Conclusion



	-----------------jquery render blocking------------------------ 
<?php
add_action('plugins_loaded','ao_defer_inline_init');
function ao_defer_inline_init() {
	if ( get_option('autoptimize_js_include_inline') != 'on' ) {
		add_filter('autoptimize_html_after_minify','ao_defer_inline_jquery',10,1);
	}
}
function ao_defer_inline_jquery( $in ) {
  if ( preg_match_all( '#<script.*>(.*)</script>#Usmi', $in, $matches, PREG_SET_ORDER ) ) {
    foreach( $matches as $match ) {
      if ( $match[1] !== '' && ( strpos( $match[1], 'jQuery' ) !== false || strpos( $match[1], '$' ) !== false ) ) {
        // inline js that requires jquery, wrap deferring JS around it to defer it. 
        $new_match = 'var aoDeferInlineJQuery=function(){'.$match[1].'}; if (document.readyState === "loading") {document.addEventListener("DOMContentLoaded", aoDeferInlineJQuery);} else {aoDeferInlineJQuery();}';
        $in = str_replace( $match[1], $new_match, $in );
      } else if ( $match[1] === '' && strpos( $match[0], 'src=' ) !== false && strpos( $match[0], 'defer' ) === false ) {
        // linked non-aggregated JS, defer it.
        $new_match = str_replace( '<script ', '<script defer ', $match[0] );
        $in = str_replace( $match[0], $new_match, $in );
      }
    }
  }
  return $in;
}
###### Enable text compression #####      for test visit >>>  http://www.whatsmyip.org/http-compression-test/
# compress text, html, javascript, css, xml:
AddOutputFilterByType DEFLATE text/plain
AddOutputFilterByType DEFLATE text/html
AddOutputFilterByType DEFLATE text/xml
AddOutputFilterByType DEFLATE text/css
AddOutputFilterByType DEFLATE application/xml
AddOutputFilterByType DEFLATE application/xhtml+xml
AddOutputFilterByType DEFLATE application/rss+xml
AddOutputFilterByType DEFLATE application/javascript
AddOutputFilterByType DEFLATE application/x-javascript
AddType x-font/otf .otf
AddType x-font/ttf .ttf
AddType x-font/eot .eot
AddType x-font/woff .woff
AddType image/x-icon .ico
AddType image/png .png
# BEGIN LiteSpeed
<IfModule Litespeed>
SetEnv noabort 1
</IfModule>
# END LiteSpeed
# compress text, html, javascript, css, xml:
<IfModule mod_deflate.c>
  # Compress HTML, CSS, JavaScript, Text, XML and fonts
  AddOutputFilterByType DEFLATE application/javascript
  AddOutputFilterByType DEFLATE application/rss+xml
  AddOutputFilterByType DEFLATE application/vnd.ms-fontobject
  AddOutputFilterByType DEFLATE application/x-font
  AddOutputFilterByType DEFLATE application/x-font-opentype
  AddOutputFilterByType DEFLATE application/x-font-otf
  AddOutputFilterByType DEFLATE application/x-font-truetype
  AddOutputFilterByType DEFLATE application/x-font-ttf
  AddOutputFilterByType DEFLATE application/x-javascript
  AddOutputFilterByType DEFLATE application/xhtml+xml
  AddOutputFilterByType DEFLATE application/xml
  AddOutputFilterByType DEFLATE font/opentype
  AddOutputFilterByType DEFLATE font/otf
  AddOutputFilterByType DEFLATE font/ttf
  AddOutputFilterByType DEFLATE image/svg+xml
  AddOutputFilterByType DEFLATE image/x-icon
  AddOutputFilterByType DEFLATE text/css
  AddOutputFilterByType DEFLATE text/html
  AddOutputFilterByType DEFLATE text/javascript
  AddOutputFilterByType DEFLATE text/plain
  AddOutputFilterByType DEFLATE text/xml
  # Remove browser bugs (only needed for really old browsers)
  BrowserMatch ^Mozilla/4 gzip-only-text/html
  BrowserMatch ^Mozilla/4\.0[678] no-gzip
  BrowserMatch \bMSIE !no-gzip !gzip-only-text/html
  Header append Vary User-Agent
</IfModule>
#Disable Etags
<IfModule mod_headers.c>
   Header unset Etag
   Header set Connection keep-alive
</IfModule>
<IfModule mod_expires.c>
  ExpiresActive On
  
  # Images
  ExpiresByType image/jpeg "access plus 1 year"
  ExpiresByType image/gif "access plus 1 year"
  ExpiresByType image/png "access plus 1 year"
  ExpiresByType image/webp "access plus 1 year"
  ExpiresByType image/svg+xml "access plus 1 year"
  ExpiresByType image/x-icon "access plus 1 year"
  # Video
  ExpiresByType video/mp4 "access plus 1 year"
  ExpiresByType video/mpeg "access plus 1 year"
  # CSS, JavaScript
  ExpiresByType text/css "access plus 1 month"
  ExpiresByType text/javascript "access plus 1 month"
  ExpiresByType application/javascript "access plus 1 month"
  # Others
  ExpiresByType application/pdf "access plus 1 month"
  ExpiresByType application/x-shockwave-flash "access plus 1 month"
</IfModule>
# TN - BEGIN Cache-Control Headers
<ifModule mod_headers.c>
<filesMatch "\.(ico|jpe?g|png|gif|swf)$">
    Header set Cache-Control "public"
    </filesMatch>
    <filesMatch "\.(css)$">
    Header set Cache-Control "public"
    </filesMatch>
    <filesMatch "\.(js)$">
    Header set Cache-Control "private"
    </filesMatch>
    <filesMatch "\.(x?html?|php)$">
    Header set Cache-Control "private, must-revalidate"
</filesMatch>
</ifModule>
# TN - END Cache-Control Headers
