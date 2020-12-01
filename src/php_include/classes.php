<?php
class User {
    public $kd_nr;
    public $email;
    public $firstname;
    public $lastname;
    public $street;
    public $zip;
    public $city;
    public $country;
    public $phone;
    public $is_admin;
}

class Article {
    public $id;
    public $name;
    public $price;
    public $category_id;
    public $category_name;
}

class Category {
    public $id;
    public $name;
}
?>