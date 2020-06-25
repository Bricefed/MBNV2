<?php

namespace App\Controller;

use App\Entity\Devis;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DevisController extends AbstractController
{
    /**
     * @Route("/devis", name="devis")
     */
    public function index(Request $request, EntityManagerInterface $manager, MailerInterface $mailer)
    {
        $devis = new Devis();

        $form = $this->createFormBuilder($devis)
                    ->add('prenom', TextType::class)
                    ->add('nom', TextType::class)
                    ->add('departement', ChoiceType::class,[
                        'choices' => [
                            'Département' => null,
                            '01' => '01',
                            '02' => '02',
                            '03' => '03',
                            '04' => '04',
                            '05' => '05',
                            '06' => '06',
                            '07' => '07',
                            '08' => '08',
                            '09' => '09',
                            '10' => '10',
                            '11' => '11',
                            '12' => '12',
                            '13' => '13',
                            '14' => '14',
                            '15' => '15',
                            '16' => '16',
                            '17' => '17',
                            '18' => '18',
                            '19' => '19',
                            '20' => '20',
                            '21' => '21',
                            '22' => '22',
                            '23' => '23',
                            '24' => '24',
                            '25' => '25',
                            '26' => '26',
                            '27' => '27',
                            '28' => '28',
                            '29' => '29',
                            '30' => '30',
                            '31' => '31',
                            '32' => '32',
                            '33' => '33',
                            '34' => '34',
                            '35' => '35',
                            '36' => '36',
                            '37' => '37',
                            '38' => '38',
                            '39' => '39',
                            '40' => '40',
                            '41' => '41',
                            '42' => '42',
                            '43' => '43',
                            '44' => '44',
                            '45' => '45',
                            '46' => '46',
                            '47' => '47',
                            '48' => '48',
                            '49' => '49',
                            '50' => '50',
                            '51' => '51',
                            '52' => '52',
                            '53' => '53',
                            '54' => '54',
                            '55' => '55',
                            '56' => '56',
                            '57' => '57',
                            '58' => '58',
                            '59' => '59',
                            '60' => '60',
                            '61' => '61',
                            '62' => '62',
                            '63' => '63',
                            '64' => '64',
                            '65' => '65',
                            '66' => '66',
                            '67' => '67',
                            '68' => '68',
                            '69' => '69',
                            '70' => '70',
                            '71' => '71',
                            '72' => '72',
                            '73' => '73',
                            '74' => '74',
                            '75' => '75',
                            '76' => '76',
                            '77' => '77',
                            '78' => '78',
                            '79' => '79',
                            '80' => '80',
                            '81' => '81',
                            '82' => '82',
                            '83' => '83',
                            '84' => '84',
                            '85' => '85',
                            '86' => '86',
                            '87' => '87',
                            '88' => '88',
                            '89' => '89',
                            '90' => '90',
                            '91' => '91',
                            '92' => '92',
                            '93' => '93',
                            '94' => '94',
                            '95' => '95',
                            '971' => '971',
                            '972' => '972',
                            '973' => '973',
                            '974' => '974',
                            '976' => '976',
                            '976' => '976',
                            '2a' => '2a',
                            '2b' => '2b'
                        ]
                    ])
                    ->add('email', EmailType::class)
                    ->add('meubles', ChoiceType::class,[
                        'choices' => [
                            'Meubles' => null,
                            'Table à manger' => 'Table à manger',
                            'Table basse' => 'Table basse',
                            'Planche à découper' => 'Planche à découper'
                        ]
                    ])
                    ->add('longueur', IntegerType::class)
                    ->add('largeur', IntegerType::class)
                    ->add('typeBois', ChoiceType::class,[
                        'choices' => [
                            'Type de bois' => null,
                            'Sapin' => 'Sapin',
                            'Chêne' => 'Chêne',
                            'Pin' => 'Pin'
                        ]
                    ])
                    ->add('budget', ChoiceType::class,[
                        'choices' => [
                            'Budget' => null,
                            'Moins de 500€' => '> 500€',
                            'Entre 500€ et 1000€' => 'De 500€ à 1000€',
                            'Entre 1000€ et 2000€' => 'De 1000€ à 2000€',
                            'Plus de 2000€' => '< 2000€'
                        ]
                    ])
                    ->add('message', CKEditorType::class)
                    ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $devis = $form->getData();
            
            $emailClient = (new Email())
                ->from('meublesbynicolas@gmail.com')
                ->to($devis->getEmail())
                ->subject('Demande de devis')
                ->text('Demande de devis')
                ->html($this->renderView(
                    'mail_devis/index.html.twig', compact('devis')
                )
            );
            $mailer->send($emailClient);


            $emailAdmin = (new Email())
                ->from($devis->getEmail())
                ->to('napofedoubrice@gmail.com')
                ->subject('Nouvelle demande de devis')
                ->text('Nouvelle demande de devis')
                ->html($this->renderView(
                    'mail_devis/index2.html.twig', compact('devis')
                )
            );
            $mailer->send($emailAdmin);

            return $this->redirectToRoute('confirmDevis');
        }

        return $this->render('devis/index.html.twig', [
            "nav_activ" => 'devis',
            "form" => $form->createView()
        ]);
    }
    
    /**
     * @Route("/confirm", name="confirmDevis")
     */
    public function messageConfirm(){
        return $this->render('devis/confirm.html.twig');
    }
}
