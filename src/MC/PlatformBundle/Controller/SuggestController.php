<?php

// src/MC/PlatformBundle/Controller/SuggestController.php

namespace MC\PlatformBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use MC\PlatformBundle\Entity\Category;
use MC\PlatformBundle\Entity\Suggest;
use MC\PlatformBundle\Form\SuggestType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class SuggestController extends Controller
{
    public function indexAction(){
        $user=$this->getUser();

        if (null === $user) {
        // Ici, l'utilisateur est anonyme ou l'URL n'est pas derrière un pare-feu
            return $this->render('MCPlatformBundle:Suggest:index.html.twig');
        }
        else {
         // Ici, $user est une instance de notre classe User
        $listSuggests = $this->getDoctrine()
            ->getManager()
            ->getRepository('MCPlatformBundle:Suggest')
            ->findBy(
                array('recipient' => $user),
                array('date' => 'desc')
                );

        return $this->render('MCPlatformBundle:Suggest:home.html.twig', array(
            'listSuggests' => $listSuggests,
            ));
        }}

    public function viewAction(Suggest $suggest){
        return $this->render('MCPlatformBundle:Suggest:view.html.twig', array(
            'suggest' => $suggest,
    ));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function addAction(Request $request){
        $user = $this->getUser();
        $suggest = new Suggest();
        $form   = $this->get('form.factory')->create(SuggestType::class, $suggest);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();


            $suggest->setAuthor($this->getUser());
            $em->persist($suggest);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirectToRoute('mc_platform_view', array('id' => $suggest->getId()));
        }
        return $this->render('MCPlatformBundle:Suggest:add.html.twig', array(
            'form' => $form->createView(),
            ));
    }


        /*
        $em = $this->getDoctrine()->getManager();
        $suggest->setCategory($em->getRepository('MCPlatformBundle:Category')->findOneBy(array('name'=>'Film')));
        $suggest->setAuthor($em->getRepository('MCPlatformBundle:Person')->findOneBy(array('first_name'=>'Zinedine')));
        $suggest->setRecipient($em->getRepository('MCPlatformBundle:Person')->findOneBy(array('first_name'=>'Zinedine')));
        $suggest->setTitle('Seven - Incroybale, à voir');
        $suggest->setContent('C\'est l\'histoire d\'un flic qui essaye d\'attraper un psycopathe et c\'est vraiment incroyable');
        */
    public function deleteAction(){

    }
}