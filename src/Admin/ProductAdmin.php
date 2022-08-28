<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class ProductAdmin extends ExtendableEntityAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('price')
            ->add('stock');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('name')
            ->add('price')
            ->add('stock')
            ->add('data');
        $fields = $this->getSettingsFields('Product');
        foreach ($fields as $field) {
            $fieldName = $field->getName();
            $fieldType = $field->getType();
            // dump($fieldName . '-' . $fieldType);
            $list->add($fieldName);
        }
        $list->add(ListMapper::NAME_ACTIONS, null, [
            'actions' => [
                'show' => [],
                'edit' => [],
                'delete' => [],
            ],
        ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('name')
            ->add('price')
            ->add('stock');
        $fields = $this->getSettingsFields('Product');
        foreach ($fields as $field) {
            $fieldName = $field->getName();
            $fieldType = $field->getType();
            // dump($fieldName . '-' . $fieldType);
            $form->add($fieldName);
        }
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('price')
            ->add('stock');
        $fields = $this->getSettingsFields('Product');
        foreach ($fields as $field) {
            $fieldName = $field->getName();
            $fieldType = $field->getType();
            // dump($fieldName . '-' . $fieldType);
            $show->add($fieldName);
        }
    }
}
