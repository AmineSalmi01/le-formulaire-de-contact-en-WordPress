<?php
/**
 * Plugin Name: amine salmi  
 * Plugin URI: https://wordpress.com
 * Description: Plugin pour créer personnaliser le formulaire de contact en WordPress.
 * Version: 1.0
 * Author: amine
 * Author URI: https://wordpress.com
 */
?>
<head>
    <style>
        .env{
            background-color: black !important;
            color: white !important;
            padding: 15px 20px !important;
            border-style: none !important;
            margin-top: 10px;
            border-radius: 9px;
        }
        .env:hover{
            background-color: white !important;
            color: black !important;
        }
        .box{
            margin: 5px !important;
        }
        .submit{
            background-color: white !important;
            margin-top: 15px !important;
        }
        .submit:hover{
            background-color: black !important;
        }
    </style>
</head>
<?php
    // AFFICHER LA PAGE DE REGLAGES AU DASHBOARD ADMIN
    function my_setup_page(){
        add_menu_page( 'Contact Form', 'Plugin amine', 'manage_options', 'test-plugin','wp_setup_function');
    }
    add_action('admin_menu', 'my_setup_page');

    function wp_setup_function(){
        $fname_check = "";
        $lname_check = "";
        $email_check = "";
        $number_check = "";
        $message_check = "";
        if(get_option('fname')){
            $fname_check = "checked";
        }
        if(get_option('lname')){
            $lname_check = "checked";
        }
        if(get_option('email')){
            $email_check = "checked";
        }
        if(get_option('number')){
            $number_check = "checked";
        }
        if(get_option('message')){
            $message_check = "checked";
        }
        echo '<form method="POST" action="">
                <div style="display:flex; flex-direction: column; align-items: flex-start">
                    <h1>Créer un formulaire de contact </h1> 
                    <Label><input class="box" type="checkbox" name="fname" '. $fname_check .'>First Name</Label>
                    <Label><input class="box" type="checkbox" name="lname" '. $lname_check .'>Last Name</Label>
                    <Label><input class="box" type="checkbox" name="email" '. $email_check .'>Email</Label>
                    <Label><input class="box" type="checkbox" name="number" '. $number_check .'>number</Label>
                    <Label><input class="box" type="checkbox" name="message" '. $message_check .'>Message</Label>
                    <input class="env" type="submit" name="submit_btn">
                </div>
             </form>';
    }

    if(isset($_POST["submit_btn"])){
        $list["fname"] = 0;
        $list["lname"] = 0;
        $list["email"] = 0;
        $list["number"] = 0;
        $list["message"] = 0;

        if(isset($_POST["fname"])){
            $list["fname"] = 1;   
        }

        if(isset($_POST["lname"])){
            $list["lname"] = 1;
        }

        if(isset($_POST["email"])){
            $list["email"] = 1; 
        }

        if(isset($_POST["number"])){
            $list["number"] = 1; 
        }

        if(isset($_POST["message"])){
            $list["message"] = 1;
        }

        update_option('fname', $list["fname"]);
        update_option('lname', $list["lname"]);
        update_option('email', $list["email"]);
        update_option('number', $list["number"]);
        update_option('message', $list["message"]);

    }
//FORM
    function add_form(){
        $form_added = false; 
        echo '<form action="">';
        if(get_option("fname")){
            echo '<label>First Name<input type="text"></label>';
            $form_added = true;
        }
        if(get_option("lname")){
            echo '<label>Last Name<input type="text"></label>';
            $form_added = true;
        }
        if(get_option("email")){
            echo '<label>Email<input type="text"></label>';
            $form_added = true;
        }
        if(get_option("number")){
            echo '<label>number<input type="number"></label>';
            $form_added = true;
        }
        if(get_option("message")){
            echo '<label>Message:<textarea name="message" cols="30" rows="10"></textarea></label>';
            $form_added = true;
        }
        if($form_added){
            echo '<input type="submit" value="Submit"  class="submit">';
        }
    }
    echo"</form>";
    add_shortcode('input','add_form');
?> 
