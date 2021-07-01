<?php

/*
Plugin Name: CCN Doação e Permuta
Plugin URI: http://www.elizeohamu.com.br
Description: Plugin CCN
Version: 1.0.0
details_url: "https://github.com/elizeohamu/ccn-permuta",
download_url: "https://github.com/elizeohamu/ccn-permuta/archive/refs/heads/master.zip"
Author: Elízeo Hamu
Author URI: http://www.elizeohamu.com.br
Text Domain: ccn-permuta
Licence: GPLv2
*/

function criando_post_type() {
    $ccn_labels = array(
    'name' => 'Doação e Permuta',
    'singular_name' => 'Veja a pergunta',
    'add_new' => 'Adicionar Doação/Permuta',
    'add_new_item' => 'Adicionar novo item',
    'edit_item' => 'Editar Doação/Permuta',
    'new_item' => 'Novo Doação/Permuta',
    'all_items' => 'Todos os resultados',
    'view_item' => 'Mostrar item',
    'search_items' => 'Procurar',
    'not_found' => 'Nenhum resultado encontrado',
    'not_found_in_trash' => 'Nenhum resultado encontrado na lixeira',
    'menu_name' => 'Doação e Permuta',    
); 
    
$ccn_args = array(
    'label' => 'ccn_permuta',
    'description' => 'CCN Control',
    'labels' => $ccn_labels,
    'supports' => array( 'title', 'editor', 'thumbnail'),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_icon' => 'dashicons-controls-repeat',
    'query_var' => false,
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'rewrite' => false,     
);   
    register_post_type('ccn_permuta', $ccn_args);
} 
    
function flw_shortcode() {
    $shortCodeArray = array(
    'post_type' => 'ccn_permuta',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    ); 
    
    $query = new WP_Query($shortCodeArray);
    while ($query->have_posts()) : $query->the_post(); ?>
   
        <div class="exchange-card">
            <h4><?php the_title(); ?></h4>            
            <?php 
                $post_id = get_the_id(); 
                ?>
                <ul>
                    <li>
                        <i class="fas fa-phone"></i><span><?php echo get_post_meta( $post_id, 'metabox-content1', true ); ?></span>                       
                    </li>
                    <li>
                        <i class="fas fa-phone"></i><span><?php echo get_post_meta( $post_id, 'metabox-content2', true ); ?></span>                                
                    </li>    
                    <li>
                        <i class="fas fa-phone"></i><span><?php echo get_post_meta( $post_id, 'metabox-content3', true ); ?></span>                       
                    </li>
                    <li>
                        <i class="fas fa-phone"></i><span><?php echo get_post_meta( $post_id, 'metabox-content4', true ); ?></span>                                
                    </li>                           
                </ul>
                <a href="<?php the_permalink(); ?>">Ver mais</a>                                                                
        </div>               
                   
    
    <?php
    endwhile;

    ?>

    <?php 
    }
?>

<?php

    function fazendoChamadaAddBox() {       
        add_meta_box( 'locals_area', 'Adicionar Locais','criandoFormulario','ccn_permuta','normal','high');
    }
        
    function criandoFormulario($post) { 
?>
            <label for="local-1">Instituição 1</label>
            <input type="text" name="local-1" value="<?php echo get_post_meta( $post->ID, 'metabox-content1', true ); ?>" />
            <br>
            <br>
            <label for="local-2">Instituição 2</label>
            <input type="text" name="local-2" value="<?php echo get_post_meta( $post->ID, 'metabox-content2', true ); ?>" />
            <br>
            <br>
            <label for="local-3">Instituição 3</label>
            <input type="text" name="local-3" value="<?php echo get_post_meta( $post->ID, 'metabox-content3', true ); ?>" />
            <br>
            <br>
            <label for="local-4">Instituição 4</label>
            <input type="text" name="local-4" value="<?php echo get_post_meta( $post->ID, 'metabox-content4', true ); ?>" />
            <?php
    }
           
/**
 *  Save textbox content
 */
function save_meta_box_content( $post_id ) {
    $textbox_content1 = $_POST['local-1'];
    $textbox_content2 = $_POST['local-2'];
    $textbox_content3 = $_POST['local-3'];
    $textbox_content4 = $_POST['local-4'];
    
    update_post_meta( $post_id, 'metabox-content1', $textbox_content1 );
    update_post_meta( $post_id, 'metabox-content2', $textbox_content2 );  
    update_post_meta( $post_id, 'metabox-content3', $textbox_content3 ); 
    update_post_meta( $post_id, 'metabox-content4', $textbox_content4 );         
    
}    
 
add_action('init', 'criando_post_type'); //Ativando a função
add_shortcode("ccn-permuta", "flw_shortcode"); 
add_action('save_post', 'save_meta_box_content');         
add_action('add_meta_boxes', 'fazendoChamadaAddBox'); 