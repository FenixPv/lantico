<?php

namespace App\Controller\Cpanel;

use App\Entity\Page;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title', 'Title');
        yield TextField::new('slug', 'Slug');
        yield TextareaField::new('description', 'Описание');
        yield ImageField::new('cover', 'Обложка')
            ->setUploadDir('public/page/images');
        yield TextEditorField::new('Body', 'Тело страницы')->setFormType(CKEditorType::class);

        $createdAt = DateTimeField::new('createdAt')->setFormTypeOptions(options: [
            'years' => range(date('Y'), end: date(format: 'Y') + 5),
            'widget' => 'single_text',
        ]);

        if (Crud::PAGE_EDIT === $pageName) {
            yield $createdAt->setFormTypeOption('disabled', true);
        }
    }

    public function configureCrud(Crud $crud):Crud
    {
        return $crud
            ->setEntityLabelInSingular('Добавить страницу')
            ->setEntityLabelInPlural('Страницы сайта')
            ->setSearchFields(['title', 'slug'])
            ->setDefaultSort(['createdAt' => 'DESC'])
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }
}
