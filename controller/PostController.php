<?php
namespace App\controller;

use App\core\Controller;
use App\model\Post;

class PostController extends Controller
{

    public function list()
    {
        //recupérer les information du Model
        $posts = (new Post())->getAll();
        // effectuer l'affichage

        $this->renderView('post/list_posts', [
            'posts' => $posts,
            'author' => 'Lia'
        ]);

    }

    public function show($id)
    {
        //recupérer les information du Model
        dd($id);
        // effectuer l'affichage
        require_once __DIR__ . '/../view/show_post.php';
    }

    public function edit($id)
    {

    }


}