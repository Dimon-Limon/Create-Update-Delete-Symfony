<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\People;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="start")
     */
    public function helloAction(Request $request)
    {
        $article = new Article();

        $rep= $this->getdoctrine()->getrepository('AppBundle:Article')->findall();
        
        $form= $this->createform(ArticleType::class, $article);
        
        $paginator  = $this->get('knp_paginator');
        $result = $paginator->paginate(
                $rep, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                3/*limit per page*/
            );

        

        $form->handleRequest($request);
        if($form->isSubmitted()){

            $em=$this->getDoctrine()->getmanager();
            $em->persist($article);
            $em->flush();
            return $this->redirect('/');
        }

        
       return $this->render('hello/index.html.twig',['form'=>$form->createView(),'articles'=>$result] );
    }

    /**
     * @Route("/show/{id}", name="showArt")
     */
    public function showbyidAction($id, Request $request)
    {
        $rep= $this->getdoctrine()->getrepository('AppBundle:Article')->find($id);
        $form= $this->createform(ArticleType::class, $rep);

        $form->handleRequest($request);
        if($form->isSubmitted()){

            $em=$this->getDoctrine()->getmanager();
            $em->persist($rep);
            $em->flush();
            return $this->redirect('/');
        }

        return $this->render('hello/showbyid.html.twig', array('form'=> $form->createView() ));


    }
    /**
     * @Route("/show", name="show")
     */
    public function showAction()
    {
        $rep= $this->getdoctrine()->getrepository('AppBundle:Article')->findall();
        return $this->render('hello/show.html.twig',['articles'=>$rep]);
    }
    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteAction($id)
    {
        $rep= $this->getDoctrine()->getrepository('AppBundle:Article')->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($rep);
        $em->flush();

        return $this->redirect($this->generateUrl('start'));
    }
}
