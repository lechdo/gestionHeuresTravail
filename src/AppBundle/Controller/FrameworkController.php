<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Framework;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Framework controller.
 *
 * @Route("framework")
 */
class FrameworkController extends Controller
{
    /**
     * Lists all framework entities.
     *
     * @Route("/", name="framework_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $frameworks = $em->getRepository('AppBundle:Framework')->findAll();

        return $this->render('framework/index.html.twig', array(
            'frameworks' => $frameworks,
        ));
    }

    /**
     * Creates a new framework entity.
     *
     * @Route("/new", name="framework_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $framework = new Framework();
        $form = $this->createForm('AppBundle\Form\FrameworkType', $framework);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($framework);
            $em->flush();

            return $this->redirectToRoute('framework_show', array('id' => $framework->getId()));
        }

        return $this->render('framework/new.html.twig', array(
            'framework' => $framework,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a framework entity.
     *
     * @Route("/{id}", name="framework_show")
     * @Method("GET")
     */
    public function showAction(Framework $framework)
    {
        $deleteForm = $this->createDeleteForm($framework);

        return $this->render('framework/show.html.twig', array(
            'framework' => $framework,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing framework entity.
     *
     * @Route("/{id}/edit", name="framework_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Framework $framework)
    {
        $deleteForm = $this->createDeleteForm($framework);
        $editForm = $this->createForm('AppBundle\Form\FrameworkType', $framework);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('framework_edit', array('id' => $framework->getId()));
        }

        return $this->render('framework/edit.html.twig', array(
            'framework' => $framework,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a framework entity.
     *
     * @Route("/{id}", name="framework_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Framework $framework)
    {
        $form = $this->createDeleteForm($framework);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($framework);
            $em->flush();
        }

        return $this->redirectToRoute('framework_index');
    }

    /**
     * Creates a form to delete a framework entity.
     *
     * @param Framework $framework The framework entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Framework $framework)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('framework_delete', array('id' => $framework->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
