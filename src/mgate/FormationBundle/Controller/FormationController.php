<?php
namespace mgate\FormationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use mgate\FormationBundle\Form\FormationType;

use mgate\FormationBundle\Entity\Formation;

class FormationController extends Controller
{
    /**
     * @Secure(roles="ROLE_CA")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('mgateFormationBundle:Formation')->findAll();
      
        return $this->render('mgateFormationBundle:Formation:index.html.twig', array(
            'formations' => $entities,
        ));
    }
    
    /**
     * @Secure(roles="ROLE_CA")
     */
    public function modifierAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        if( ! $formation = $em->getRepository('mgate\FormationBundle\Entity\Formation')->find($id) )
        {
            $formation = new Formation;
        }
      
        $form = $this->createForm(new FormationType, $formation);
        
        if( $this->get('request')->getMethod() == 'POST' )
        {
            $form->bindRequest($this->get('request'));
               
            if( $form->isValid() )
            {
                $em->persist($formation);
                $em->flush();
                
                $form = $this->createForm(new FormationType(), $formation);
            }
        }
        
        return $this->render('mgateFormationBundle:Formation:modifier.html.twig', array(
            'form' => $form->createView(),
            'formation' => $formation,
        ));
    }
}