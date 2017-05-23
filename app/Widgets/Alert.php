<?php

namespace App\Widgets;

use Illuminate\Contracts\Session\Session;

class Alert extends BaseWidget
{
    const ALERT_KEY = 'ALERT_FLASH';
    protected $config;
    private $session;

    public function __construct(Session $session, $config)
    {
        $this->session = $session;
        $this->config = $config;
    }

    public function setMessage($type, $message, $hasCloseButton = null, $needContainer = null)
    {
        if (!in_array($type, $this->config['allow_type_list'])) {
            $type = $this->config['default_type'];
        }
        if (is_null($hasCloseButton)) {
            $hasCloseButton = $this->config['default_has_button'];
        }
        if (is_null($needContainer)) {
            $needContainer = $this->config['default_need_container'];
        }
        $this->session->flash(
            static::ALERT_KEY, [
            'type' => $type,
            'message' => $message,
            'hasCloseButton' => (boolean)$hasCloseButton,
            'needContainer' => (boolean)$needContainer
            ]
        );
    }

    public function setInfo($message)
    {
        $this->setMessage('info', $message);
    }

    public function setSuccess($message)
    {
        $this->setMessage('success', $message);
    }

    public function setWarning($message)
    {
        $this->setMessage('warning', $message);
    }

    public function setDanger($message)
    {
        $this->setMessage('danger', $message);
    }

    public function getData()
    {
        if($this->session->has(static::ALERT_KEY)){
            return $this->session->get(static::ALERT_KEY);
        }else{
            return [];
        }
    }
    public function render()
    {
        if($this->session->has(static::ALERT_KEY)){
            return parent::render();
        }else{
            return '';
        }
    }
}
