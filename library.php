<?php


/**
 * The installation script for the module.
 */
function blank_form__install($module_id)
{
  global $g_table_prefix, $LANG;

  ft_register_hook("template", "blank_form", "admin_forms_list_bottom", "", "bf_display_create_form_button");

  return array(true, "");
}


/**
 * Displays the actual "CREATE BLANK FORM >>" button.
 *
 * @param $vars
 */
function bf_display_create_form_button($vars)
{
	global $g_root_url;

	$L = ft_get_module_lang_file_contents("blank_form");

	echo <<<EOF
<div style="border-top: 1px solid #cccccc; margin: 10px 0px"></div>
<form action="$g_root_url/modules/blank_form/create.php" method="post">
  <input type="submit" value="{$L["phrase_create_blank_form_rightarrows"]}" />
</form>
EOF;
}
