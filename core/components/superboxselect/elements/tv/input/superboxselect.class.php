<?php

/**
 * SuperBoxSelect Input Render
 *
 * Copyright 2011-2016 by Benjamin Vauchel <contact@omycode.fr>
 *
 * @package superboxselect
 * @subpackage input_render
 */
class SuperboxselectInputRender extends modTemplateVarInputRender
{
    public function getTemplate()
    {
        $corePath = $this->modx->getOption('superboxselect.core_path', null, $this->modx->getOption('core_path') . 'components/superboxselect/');
        return $corePath . 'elements/tv/input/tpl/superboxselect.render.tpl';
    }

    public function process($value, array $params = array())
    {
        // Load superboxselect class
        $corePath = $this->modx->getOption('superboxselect.core_path', null, $this->modx->getOption('core_path') . 'components/superboxselect/');
        $superboxselect = $this->modx->getService('superboxselect', 'Superboxselect', $corePath . 'model/superboxselect/', array(
            'core_path' => $corePath
        ));
        // Load required javascripts & register global config
        $superboxselect->includeScriptAssets();

        $params = array_merge($params, array(
            'resourceId' => ($this->modx->resource) ? $this->modx->resource->get('id') : 0,
            'contextKey' => ($this->modx->resource) ? $this->modx->resource->get('context_key') : 'web'
        ));

        $this->setPlaceholder('params', $params);
        $this->setPlaceholder('value', str_replace('||', ',', $value));
        $this->setPlaceholder('connector', $superboxselect->getOption('assetsUrl') . 'connector.php');
    }
}

return 'SuperboxselectInputRender';
