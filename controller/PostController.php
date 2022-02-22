<?php

class PostController extends Controller
{

    public function list()
    {
        //recupérer les information du Model

        // effectuer l'affichage


        //$this->renderView('list_posts');
        $this->redirectToRoute('accueil');
    }

    public function show($id)
    {
//recupérer les information du Model

        // effectuer l'affichage
        require_once __DIR__.'/../view/show_post.php';
    }

    public function edit($id)
    {

    }


}