<?php

class __Mustache_b95b9e8629ac334c634da909915d21bb extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<header id="page-header" class="row">
';
        $buffer .= $indent . '    <div class="col-12 pt-3 pb-3">
';
        $buffer .= $indent . '        <div class="card ';
        $value = $context->find('contextheader');
        if (empty($value)) {
            
            $buffer .= 'border-0 bg-transparent';
        }
        $buffer .= '">
';
        $buffer .= $indent . '            <div class="card-body ';
        $value = $context->find('contextheader');
        if (empty($value)) {
            
            $buffer .= 'p-2';
        }
        $buffer .= '">
';
        $buffer .= $indent . '                <div class="d-flex align-items-center">
';
        $buffer .= $indent . '                    <div class="me-auto">
';
        $buffer .= $indent . '                    ';
        $value = $this->resolveValue($context->find('contextheader'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                    <div class="header-actions-container flex-shrink-0" data-region="header-actions-container">
';
        $value = $context->find('headeractions');
        $buffer .= $this->section4eef411a16a2a0584c7e8d40fdc461b8($context, $indent, $value);
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '                <div class="d-flex flex-wrap">
';
        $value = $context->find('hasnavbar');
        $buffer .= $this->section0cfab5d9b41b9a13eee3763050c03dca($context, $indent, $value);
        $buffer .= $indent . '                    <div class="ms-auto d-flex">
';
        $buffer .= $indent . '                        ';
        $value = $this->resolveValue($context->find('pageheadingbutton'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                    <div id="course-header">
';
        $buffer .= $indent . '                        ';
        $value = $this->resolveValue($context->find('courseheader'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $value = $context->find('welcomemessage');
        $buffer .= $this->sectionC9fea3e8bb81ae97df0806971e1ec037($context, $indent, $value);
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</header>
';

        return $buffer;
    }

    private function section4eef411a16a2a0584c7e8d40fdc461b8(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                            <div class="header-action ms-2">{{{.}}}</div>
                        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                            <div class="header-action ms-2">';
                $value = $this->resolveValue($context->last(), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '</div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section0cfab5d9b41b9a13eee3763050c03dca(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                    <div id="page-navbar">
                        {{{navbar}}}
                    </div>
                    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                    <div id="page-navbar">
';
                $buffer .= $indent . '                        ';
                $value = $this->resolveValue($context->find('navbar'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '
';
                $buffer .= $indent . '                    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC9fea3e8bb81ae97df0806971e1ec037(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <div class="card border-0 mt-3">
                <div class="card-body py-0">
                    {{> core/welcome }}
                </div>
            </div>
        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '            <div class="card border-0 mt-3">
';
                $buffer .= $indent . '                <div class="card-body py-0">
';
                if ($partial = $this->mustache->loadPartial('core/welcome')) {
                    $buffer .= $partial->renderInternal($context, $indent . '                    ');
                }
                $buffer .= $indent . '                </div>
';
                $buffer .= $indent . '            </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
