<?php

namespace BanqueBundle\Controller;

use BanqueBundle\Entity\Banque;
use BanqueBundle\Form\BanqueType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Banque controller.
 *
 * @Route("banque")
 */
class BanqueController extends Controller
{
    /**
     * Lists all banque entities.
     *
     * @Route("/", name="banque_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $banques = $em->getRepository(Banque::class)->findAll();

        return $this->render('banque/index.html.twig', array(
            'banques' => $banques,
        ));
    }

    /**
     * Creates a new banque entity.
     *
     * @Route("/new", name="banque_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $banque = new Banque();
        $form = $this->createForm(BanqueType::class, $banque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($banque);
            $em->flush();

            return $this->redirectToRoute('banque_show', array('id' => $banque->getId()));
        }

        return $this->render('banque/new.html.twig', array(
            'banque' => $banque,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a banque entity.
     *
     * @Route("/{id}", name="banque_show")
     * @Method("GET")
     */
    public function showAction(Banque $banque)
    {
        $deleteForm = $this->createDeleteForm($banque);

        return $this->render('banque/show.html.twig', array(
            'banque' => $banque,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing banque entity.
     *
     * @Route("/{id}/edit", name="banque_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Banque $banque)
    {
        $deleteForm = $this->createDeleteForm($banque);
        $editForm = $this->createForm(BanqueType::class, $banque);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('banque_edit', array('id' => $banque->getId()));
        }

        return $this->render('banque/edit.html.twig', array(
            'banque' => $banque,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a banque entity.
     *
     * @Route("/{id}", name="banque_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Banque $banque)
    {
        $form = $this->createDeleteForm($banque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($banque);
            $em->flush();
        }

        return $this->redirectToRoute('banque_index');
    }

    /**
     * Creates a form to delete a banque entity.
     *
     * @param Banque $banque The banque entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Banque $banque)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('banque_delete', array('id' => $banque->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
