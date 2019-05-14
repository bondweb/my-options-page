<?php
/*
Plugin Name: My Plug-in
Plugin URI: #
Description: Questo pulg-in registra una nuova pagina opzioni per aggiungere un testo personalizzato nel piè pagina del sito.
Author: Mario B
Version: 1.0
Author URI: #
*/

// Registro le opzioni presenti nella pagina del Plugin 

function myplugin_register_settings() {
   add_option( 'myplugin_option_name', 'This is my option value.');
   register_setting( 'myplugin_options_group', 'myplugin_option_name', 'myplugin_callback' );
}
add_action( 'admin_init', 'myplugin_register_settings' );

// Creo la pagina opzioni del plug-in

function myplugin_register_options_page() {
  add_options_page('Page Title', 'Testo nel footer', 'manage_options', 'myplugin', 'myplugin_options_page');
}
add_action('admin_menu', 'myplugin_register_options_page');

// Visualizzo le opzioni nella pagina del plug-in

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
// Aggancio la mia funzione add_text_to_footer all'Hook 'wp_footer'
add_action("wp_footer", "add_text_to_footer");
 
// Define 'Add_Text_to_footer'
function add_Text_to_footer()
{
 $footer = get_option('myplugin_option_name');
  echo "<p style='color: white; text-align:center'>$footer</p>";
}
