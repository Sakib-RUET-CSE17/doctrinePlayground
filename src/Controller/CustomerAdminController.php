<?php

declare(strict_types=1);

namespace App\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CustomerAdminController extends CRUDController
{
    /**
     * @throws AccessDeniedException If access is not granted
     */
    public function listAction(Request $request): Response
    {
        $this->assertObjectExists($request);

        $this->admin->checkAccess('list');


        $preResponse = $this->preList($request);
        if (null !== $preResponse) {
            return $preResponse;
        }

        $listMode = $request->get('_list_mode');
        if (\is_string($listMode)) {
            $this->admin->setListMode($listMode);
        }

        // Custom code
        $jsonFilterForm = $this->container->get('form.factory')->createNamedBuilder('jsonfilter')
            ->setMethod('GET')
            ->add('email', EmailType::class, [
                'required' => false,
            ])
            ->add('purchasedCount', NumberType::class, [
                'required' => false,
            ])
            ->add('filter', SubmitType::class)
            ->getForm();
        $jsonFilterForm->handleRequest($request);
        // dd($request->query->all());
        if ($jsonFilterForm->isSubmitted() && $jsonFilterForm->isValid()) {
            $data = $jsonFilterForm->getData();
            foreach ($data as $key => $value) {
                if (!$value) {
                    unset($data[$key]);
                }
            }
            // dd($jsonFilterForm->getData(), $data);
            $this->admin->setJsonFilter($data);
        }
        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();

        // set the theme for the current Admin Form
        $this->setFormTheme($formView, $this->admin->getFilterTheme());

        $template = 'CustomerAdmin/filter.html.twig';

        if ($this->container->has('sonata.admin.admin_exporter')) {
            $exporter = $this->container->get('sonata.admin.admin_exporter');
            \assert($exporter instanceof AdminExporter);
            $exportFormats = $exporter->getAvailableFormats($this->admin);
        }


        return $this->renderWithExtraParams($template, [
            'action' => 'list',
            'form' => $formView,
            'datagrid' => $datagrid,
            'csrf_token' => $this->getCsrfToken('sonata.batch'),
            'export_formats' => $exportFormats ?? $this->admin->getExportFormats(),
            'jsonFilterForm' => $jsonFilterForm->createView(),
        ]);
    }
}
