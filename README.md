kirby1 related pages field
==========================

Rudimentary related pages field for Kirby 1.
It is a modification of the tags field.

##Usage in blueprint:

    your-fieldname-here:
      label: your field label 
      type:  related_pages
      empty: true
      templates: article, blog, news

##Usage in template:
Can probably be done easier, but I was in a rush and this worked:

    $articles = array();
    if ( isset($page->your-fieldname-here()) && !empty($page->your-fieldname-here()) ){
      foreach ( explode(',',$page->your-fieldname-here()) as $uri ) {
        $lookup = $pages->findByHash( base_convert(sprintf('%u', crc32($uri)), 10, 36) );
        if ( $lookup ) {
          $articles[] = $lookup->first();
        }
      }
    }

