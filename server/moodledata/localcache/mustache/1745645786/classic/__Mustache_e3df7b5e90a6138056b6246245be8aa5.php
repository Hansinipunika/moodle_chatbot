<?php

class __Mustache_e3df7b5e90a6138056b6246245be8aa5 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<div class="mb-3">
';
        $buffer .= $indent . '    <table id="emoticonsetting" class="admintable generaltable">
';
        $buffer .= $indent . '        <thead>
';
        $buffer .= $indent . '            <tr>
';
        $buffer .= $indent . '                <th>';
        $value = $context->find('str');
        $buffer .= $this->section6d48879d3374d43cb8168d0236a173ef($context, $indent, $value);
        $buffer .= '</th>
';
        $buffer .= $indent . '                <th>';
        $value = $context->find('str');
        $buffer .= $this->section27e0fca72a41c8b9b73bb28f83920580($context, $indent, $value);
        $buffer .= '</th>
';
        $buffer .= $indent . '                <th>';
        $value = $context->find('str');
        $buffer .= $this->sectionFdba50fcb9fca44b46c3b8562b4cc3e4($context, $indent, $value);
        $buffer .= '</th>
';
        $buffer .= $indent . '                <th colspan="2">';
        $value = $context->find('str');
        $buffer .= $this->sectionDa828860db3f86ae4c22942d5fa85623($context, $indent, $value);
        $buffer .= '</th>
';
        $buffer .= $indent . '                <th></th>
';
        $buffer .= $indent . '            </tr>
';
        $buffer .= $indent . '        </thead>
';
        $buffer .= $indent . '        <tbody>
';
        $value = $context->find('emoticons');
        $buffer .= $this->section6127a9c931bb4916f5a2293a3bcc5c5d($context, $indent, $value);
        $buffer .= $indent . '        </tbody>
';
        $buffer .= $indent . '    </table>
';
        $buffer .= $indent . '</div>
';
        $buffer .= $indent . '<div>
';
        $buffer .= $indent . '    <a href="';
        $value = $this->resolveValue($context->find('reseturl'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '">';
        $value = $context->find('str');
        $buffer .= $this->section2fc6d5c32f8f7c85a4f9d1e439c1d2e7($context, $indent, $value);
        $buffer .= '</a>
';
        $buffer .= $indent . '</div>
';

        return $buffer;
    }

    private function section6d48879d3374d43cb8168d0236a173ef(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'emoticontext, admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'emoticontext, admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section27e0fca72a41c8b9b73bb28f83920580(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'emoticonimagename, admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'emoticonimagename, admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionFdba50fcb9fca44b46c3b8562b4cc3e4(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'emoticoncomponent, admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'emoticoncomponent, admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionDa828860db3f86ae4c22942d5fa85623(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'emoticonalt, admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'emoticonalt, admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section9a0045ce353b3352bfb7d8246a408b0d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                        <td class="c{{index}}">
                            <input type="text" name="{{name}}[{{field}}]" class="form-text form-control text-ltr" value="{{value}}">
                        </td>
                    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                        <td class="c';
                $value = $this->resolveValue($context->find('index'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '">
';
                $buffer .= $indent . '                            <input type="text" name="';
                $value = $this->resolveValue($context->find('name'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '[';
                $value = $this->resolveValue($context->find('field'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= ']" class="form-text form-control text-ltr" value="';
                $value = $this->resolveValue($context->find('value'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '">
';
                $buffer .= $indent . '                        </td>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section1079dd5148f0584e61a2164de9060f4f(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                            {{>core/pix_icon}}
                        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                if ($partial = $this->mustache->loadPartial('core/pix_icon')) {
                    $buffer .= $partial->renderInternal($context, $indent . '                            ');
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section6127a9c931bb4916f5a2293a3bcc5c5d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                <tr>
                    {{#fields}}
                        <td class="c{{index}}">
                            <input type="text" name="{{name}}[{{field}}]" class="form-text form-control text-ltr" value="{{value}}">
                        </td>
                    {{/fields}}
                    <td>
                        {{#icon}}
                            {{>core/pix_icon}}
                        {{/icon}}
                    </td>
                </tr>
            ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                <tr>
';
                $value = $context->find('fields');
                $buffer .= $this->section9a0045ce353b3352bfb7d8246a408b0d($context, $indent, $value);
                $buffer .= $indent . '                    <td>
';
                $value = $context->find('icon');
                $buffer .= $this->section1079dd5148f0584e61a2164de9060f4f($context, $indent, $value);
                $buffer .= $indent . '                    </td>
';
                $buffer .= $indent . '                </tr>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section2fc6d5c32f8f7c85a4f9d1e439c1d2e7(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'emoticonsreset, admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'emoticonsreset, admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
