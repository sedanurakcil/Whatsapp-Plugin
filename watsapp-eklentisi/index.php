
<?php
global $jal_db_version;
$jal_db_version = '1.0';
/*
Plugin Name: watsapp form eklentim
Plugin URI : https://github.com/sedanurakcil
Description:Bu benim ilk eklentim 
Version :1.0
Author: Sedanur Akçil
Author URI: https://github.com/sedanurakcil

*/

// menü ekledik

add_action("admin_menu","eklentim"); 

function eklentim(){
    add_menu_page("Eklenti Başlığım ","Eklenti Adım","manage_options","eklenti_linkim","eklenti_icerigi");

}

function eklenti_icerigi()
{
    $postmeta_telefon = get_post_meta(14,"whatsapp_telefon",true);
    $postmeta_mesaj = get_post_meta(15,"whatsapp_mesaj",true);
    
  ?>
   


<form method = "post">
<label>Telefon Numaranız</label><br>
<input type = "number" name ="telefon" value = "<?php echo $postmeta_telefon;?>"><br>
<label> Mesaj içeriğimiz </label><br>
<input type ="text" name ="mesaj" value = "<?php echo $postmeta_mesaj;?>"> <br>
<input type ="submit">

</form>

<?php }

$telefon = $_POST["telefon"];
$mesaj = $_POST["mesaj"];



if($_POST){
if($telefon !=$postmeta_telefon){
    update_post_meta(14,"whatsapp_telefon",$telefon,$postmeta_telefon,true);
}
elseif($telefon == $postmeta_telefon){
    echo "bilgiler mevcuttur";

}
if($mesaj !=$postmeta_mesaj){
    update_post_meta(15,"whatsapp_mesaj",$mesaj,$postmeta_mesaj,true);
}
elseif($mesaj ==$postmeta_mesaj){
    echo "bilgiler mevcuttur";

}

}

add_action("wp_footer","whatsapp_butonu");// sayfamızın head kısmına denem yazısı geldi footer deseydik sitemizin sonun a gelecekti
function whatsapp_butonu() // yazdığımız kodlar sitede gözükecek  html ve css kodları olacak
{
   
     $eklenti_yolu  = plugin_dir_url(__FILE__);// css dosyasına ulaşmakk için kulandık link  rel dede yolu gösterdik link href whatsapp butonu iconu için siteden aldık
    $postmeta_telefon = get_post_meta(14,"whatsapp_telefon",true);
    $postmeta_mesaj = get_post_meta(15,"whatsapp_mesaj",true);
    
    
    ?>

<link rel = "stylesheet" type = "text/css" href = "<?php echo  $eklenti_yolu."assets/tasarim.css" ?>">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> 

<a href = "https://wa.me/905458748378"<?php echo $postmeta_telefon?>?text =<?php echo $postmeta_mesaj?>;  target = "blank" class ="buton">
<i  class ="fa fa-whatsapp" style = "color:white;"> </i>


</a>


<?php


}
?>