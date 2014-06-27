<?php

/*
options:
- data: predefined set of page urls
- seperator


*/

global $site;

$id    = uniqid() . '-' . $name;
$page  = $site->pages()->active();

// define the separating character
$separator = (isset($separator)) ? $separator : ',';

// field to fetch existing tags from
$field = (isset($field)) ? $field : $name;

// set templates array to given selection, or pick all templates
$templates = (isset($templates)) ? explode(',', $templates) : data::findTemplates();

// lowercase all urls
$lower = (isset($lower)) ? $lower : false;

// use passed data if available or try to fetch data
if(!isset($data) || !is_array($data)) {

  $data  = array();
  //$store = array();
  
  foreach( $site->pages()->index() as $p ) {
    if ( in_array( $p->template(), $templates ) ) {
      $data[] = $p->uri();
    }
	}
}

// make sure we get a nice array
$data = array_values(array_unique($data));
sort($data);

?>
<input type="text" id="<?php echo $id ?>" class="input" name="<?php echo html($name) ?>" value="<?php echo html($value) ?>" />

<script type="text/javascript">
$(function() {
  $('#<?php echo $id ?>').tagbox({
    url : <?php echo json_encode((array)$data) ?>, 
    lowercase : '<?php echo $lower ?>',
    separator : '<?php echo $separator ?>'
  });
});
</script>