<?php namespace Application\Core\Repositories\Languages\Interfaces;

use Application\Core\Repositories\RepositoryInterface;

interface LanguageInterface extends RepositoryInterface
{

    public function getLocale($locale);

}