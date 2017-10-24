<?php

namespace Dadata\Response\Suggestions\Party;

class ManagementDto
{
    /**
     * @var string ФИО руководителя
     */
    private $name;
    /**
     * @var string Должность руководителя
     */
    private $post;

    public function __construct($name, $post)
    {
        $this->name = $name;
        $this->post = $post;
    }

    /**
     * Получить ФИО руководителя
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Получить должность руководителя
     *
     * @return string
     */
    public function getPost()
    {
        return $this->post;
    }
}