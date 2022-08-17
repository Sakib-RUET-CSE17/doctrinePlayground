<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Settings;
use Doctrine\ORM\EntityManager;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class CustomerAdmin extends AbstractAdmin
{
    private EntityManager $entityManager;

    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('phone')
            ->add('email');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('name')
            ->add('phone')
            ->add('data')
            ->add('email')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $customer = $this->getSubject();
        $customerSettings = $this->entityManager->getRepository(Settings::class)->findOneBy(['entity' => 'Customer']);
        // dd($this->entityManager->getRepository(Settings::class)->findOneBy(['entity' => 'Customer']));

        $form
            ->add('name')
            ->add('phone');
        if ($customerSettings) {
            $customer->setSetting($customerSettings);
            $fields = $customerSettings->getFields();
            foreach ($fields as $field) {
                $fieldName = $field->getName();
                $fieldType = $field->getType();
                // dump($fieldName . '-' . $fieldType);
                $form->add($fieldName);
            }
        }
        // dd($fields[0]);

        // ->add('setting');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('data')
            ->add('email')
            ->add('phone');
    }
}
