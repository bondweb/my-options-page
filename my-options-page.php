<?php
/*
Plugin Name: My options page
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Questo pulg-in registra una nuova pagina opzioni per aggiungere un testo personalizzato nel piè pagina del sito.
Author: Mario B
Version: 1.0
Author URI: #
*/

// Register Settings For a Plugin 

function myplugin_register_settings() {
   add_option( 'myplugin_option_name', 'This is my option value.');
   register_setting( 'myplugin_options_group', 'myplugin_option_name', 'myplugin_callback' );
}
add_action( 'admin_init', 'myplugin_register_settings' );

// Creating an Options Page

function myplugin_register_options_page() {
  add_options_page('Page Title', 'Plugin Menu', 'manage_options', 'myplugin', 'myplugin_options_page');
}
add_action('admin_menu', 'myplugin_register_options_page');

// Display Settings on Option’s Page

function myplugin_options_page(){
?>
  <div>
  <?php screen_icon(); ?>
  <h2>Aggiungi un testo personalizzato nel piè di pagina</h2>
  <form method="post" action="options.php">
  <?php settings_fields( 'myplugin_options_group' ); ?>
  
  <p>Inserisci il tuo testo nel campo sottostante</p>
  <table>
  <tr valign="top">
  <th scope="row"><label for="myplugin_option_name">Testo</label></th>
  <td><input type="text" id="myplugin_option_name" name="myplugin_option_name" value="<?php echo get_option('myplugin_option_name'); ?>" /></td>
  </tr>
  </table>
  <?php submit_button(); ?>
  </form>
  </div>
<?php
} ?>

<?php
// Hook the 'wp_footer' action hook, add the function named 'mfp_Add_Text_to_footer' to it
add_action("wp_footer", "mfp_Add_Text_to_footer", 8);
 
// Define 'mfp_Add_Text_to_footer'
function mfp_Add_Text_to_footer()
{
 $piede = get_option('myplugin_option_name');
  echo "<p style='color: white; text-align:center'>$piede</p>";
}
