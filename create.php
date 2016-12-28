<?php

// this file is called directly by the administrator by clicking the "Create Blank Form >>" link
// in the UI
require_once("../../global/library.php");

$info = array(
  "form_name"    => "Blank Form",
  "form_url"     => $g_root_url,
  "redirect_url" => $g_root_url,
  "access_type"  => "admin"
);

// set up the entry for the form
list($success, $message, $new_form_id) = ft_setup_form($info);

$form_data = array(
  "form_tools_form_id" => $new_form_id,
  "form_tools_display_notification_page" => false,
  "field1" => 1,
  "field2" => 2,
  "field3" => 3,
  "field4" => 4,
  "field5" => 5
);

ft_initialize_form($form_data);


$info = array();
$form_fields = ft_get_form_fields($new_form_id);
$order = 1;
foreach ($form_fields as $field_info)
{
  if (preg_match("/field(\d+)/", $field_info["field_name"], $matches))
  {
    $field_row = $matches[1];
    $field_id  = $field_info["field_id"];
    $info["field_{$field_id}"]              = $field_row;
    $info["field_{$field_id}_size"]         = $field_info["field_size"];
    $info["field_{$field_id}_display_name"] = "Field $field_row";
    $info["field_{$field_id}_order"] = $order;
    $order++;
  }
}
ft_set_form_database_settings($info, $new_form_id);
ft_reorder_form_fields($info, $new_form_id, true);

// now finalize it!
ft_finalize_form($new_form_id);

// and redirect
header("location: $g_root_url/admin/forms/edit.php?form_id=$new_form_id");
exit;
