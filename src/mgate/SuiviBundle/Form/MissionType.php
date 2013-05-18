<?php

namespace mgate\SuiviBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use mgate\PersonneBundle\Form;
use mgate\PersonneBundle\Entity\PersonneRepository as PersonneRepository;
use mgate\PersonneBundle\Form\MembreType as MembreType;

class MissionType extends DocTypeType
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('knownIntervenant', 'checkbox', array(
                'required' => false,
                'label' => "L'intervenant existe-t-il déjà dans la base de donnée ?"
                ))
            ->add('intervenant', 'genemu_jqueryselect2_entity', array(
               'class' => 'mgate\\PersonneBundle\\Entity\\Membre',
               'property' => 'personne.prenomNom',
               'label' => 'Intervenant',
               //'query_builder' => function(PersonneRepository $pr) { return $pr->getMembreOnly(); },
               'required' => false
               ))
           ->add('newIntervenant', new MembreType(), array('label' => 'Nouvel intervenant ', 'required' => false))

        
            ->add('debutOm','genemu_jquerydate', array('label'=>'Début du Récapitulatif de Mission','required'=>false, 'widget'=>'single_text'))
            ->add('finOm','genemu_jquerydate', array('label'=>'Fin du Récapitulatif de Mission','required'=>false, 'widget'=>'single_text'))
            ->add('pourcentageJunior', 'integer', array('label'=>'Pourcentage junior', 'required' => false))
            ->add('referentTechnique', 'genemu_jqueryselect2_entity', array(
               'class' => 'mgate\\PersonneBundle\\Entity\\Membre',
               'property' => 'personne.prenomNom',
               'label' => 'Référent Technique',
               'required' => false
               ));

            //->add('avancement','integer',array('label'=>'Avancement en %'))
            //->add('rapportDemande','checkbox', array('label'=>'Rapport pédagogique demandé','required'=>false))
            //->add('rapportRelu','checkbox', array('label'=>'Rapport pédagogique relu','required'=>false))
            //->add('remunere','checkbox', array('label'=>'Intervenant rémunéré','required'=>false));                    
                               
        //->add('mission', new DocTypeType('mission'), array('label'=>' '));
        DocTypeType::buildForm($builder, $options);
            
            
    }

    public function getName()
    {
        return 'alex_suivibundle_mssiontype';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'mgate\SuiviBundle\Entity\Mission',
        );
    }
}
