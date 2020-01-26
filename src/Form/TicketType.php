<?php
namespace App\Form;
use App\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', null, array('label' => 'label_nom'))
        ->add('firstname', null, array('label' => 'label_prenom'))
        ->add('country', CountryType::class, array('label' => 'label_pays'))
        ->add('birthdate', BirthdayType::class, array(
            'label' => 'label_datenaissance',
            'widget' => 'single_text',
            'attr' => ['placeholder' => 'placeholder_1','class' => 'js-pickadate-ticket']))
        ->add('ticketprice', ChoiceType::class, array(
            'label' => 'label_type_billet',
            'choices'  => array(
                'label_journée' => true,
                'label_demi_journée' => false,)
            ))
        ->add('reducedprice', null, array('label' => 'label_reduit'));
    }
    public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults(array(
        'data_class' => Ticket::class,
    ));
}
}