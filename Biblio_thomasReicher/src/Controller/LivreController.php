<?php


namespace App\Controller;

use App\Form\LivreType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Livre;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends  AbstractController
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

    }
    /**
 * @Route("/livre/" , name="livre" , methods={"GET"})
 */
    public  function AllLivre() : Response{
        $em = $this->getDoctrine()->getManager();
        $liste= $em->getRepository(Livre::class);
        return $this->render('list.html.twig', [
            'livres' => $liste->findAll(),
        ]);



    }
    /**
     * @Route("/delete/{id}" , name="livre_delete" , methods={"GET"})
     */
    public  function Delete($id) : Response{
        $em = $this->getDoctrine()->getManager();
        $livre= $em->getRepository(Livre::class)->find($id);
        $em->remove($livre);
        $this->em->flush();
        return $this->redirectToRoute('livre');



    }

    /**
     * @Route("/insert/" , name="livre_add" )
     */
    public  function Insert(Request $request) : Response{
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($livre);
            $this->em->flush();

            return $this->redirectToRoute('livre');
        }

        return $this->render('add.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}

