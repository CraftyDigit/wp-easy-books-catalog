<?php

namespace Core;

abstract class EBCAbstractModel
{
    protected $postData = [];
    protected $postMetaData = [];
    protected $postEvaluatedData = [];

    public function __construct(int $id)
    {
        $this->postData = get_post($id, ARRAY_A);
        $this->setPostMetaData();
        $this->setPostEvaluatedData();
    }

    /**
     * @return void
     */
    abstract protected function setPostMetaData(): void;

    /**
     * @return void
     */
    abstract protected function setPostEvaluatedData(): void;

    /**
     * @param string $name
     * @return mixed
     * @throws Exception
     */
    public function __get(string $name)
    {
        $data = array_merge($this->postData, $this->postMetaData, $this->postEvaluatedData);

        if (in_array($name, array_keys($data))) {
            return $data[$name];
        } else {
            throw new Exception('Field not found in post data.');
        }
    }

}