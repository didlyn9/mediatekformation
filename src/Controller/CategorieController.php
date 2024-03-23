<?php
namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controleur de l'accueil
 *
 * @author emds
 */
class CategorieController extends AbstractController{
        
        
     /**
     * 
     * @var CategorieRepository
     */
    private $repository;
    
    /**
     * 
     * @param CategorieRepository $repository
     */
    public function __construct(CategorieRepository $repository){
        $this->repository = $repository;
    }
    
    /**
     * @Route("/categories", name="categories")
     * @return Response
     */
    public function index():Response{
        $categories = $this->repository->findAll();
        return $this->render('pages/categories.html.twig',[
            'categories'=>$categories
        ]);
    }
    
}