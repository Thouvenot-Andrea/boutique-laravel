<?php
namespace App\Http\Controllers;

class ProductController extends Controller
{
    public function index(){
        return "Liste des produits";
    }

    public function get($id)
    {
        return 'Fiche du produit '.$id;
    }
}
