<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ide;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Ide controller.
 *
 * @Route("ide")
 */
class IdeController extends Controller
{
    /**
     * Lists all ide entities.
     *
     * @Route("/", name="ide_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ides = $em->getRepository('AppBundle:Ide')->findAll();

        return $this->render('ide/index.html.twig', array(
            'ides' => $ides,
        ));
    }

    /**
     * Creates a new ide entity.
     *
     * @Route("/new", name="ide_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ide = new Ide();
        $form = $this->createForm('AppBundle\Form\IdeType', $ide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ide);
            $em->flush();

            return $this->redirectToRoute('ide_show', array('id' => $ide->getId()));
        }

        return $this->render('ide/new.html.twig', array(
            'ide' => $ide,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ide entity.
     *
     * @Route("/{id}", name="ide_show")
     * @Method("GET")
     */
    public function showAction(Ide $ide)
    {
        $deleteForm = $this->createDeleteForm($ide);

        return $this->render('ide/show.html.twig', array(
            'ide' => $ide,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ide entity.
     *
     * @Route("/{id}/edit", name="ide_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Ide $ide)
    {
        $deleteForm = $this->createDeleteForm($ide);
        $editForm = $this->createForm('AppBundle\Form\IdeType', $ide);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ide_edit', array('id' => $ide->getId()));
        }

        return $this->render('ide/edit.html.twig', array(
            'ide' => $ide,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ide entity.
     *
     * @Route("/{id}", name="ide_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Ide $ide)
    {
        $form = $this->createDeleteForm($ide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ide);
            $em->flush();
        }

        return $this->redirectToRoute('ide_index');
    }

    /**
     * Creates a form to delete a ide entity.
     *
     * @param Ide $ide The ide entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ide $ide)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ide_delete', array('id' => $ide->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
